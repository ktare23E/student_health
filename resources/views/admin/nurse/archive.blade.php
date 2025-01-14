<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->



    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">Archive Nurse List</h1>
                    </div>
                    
                    <div class="flex flex-row p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Nurse Type</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nurses as $nurse)
                                        <tr>
                                            <td class="data1">{{ $nurse->first_name }}</td>
                                            <td class="data2">{{ $nurse->last_name }}</td>
                                            <td class="data2">{{ $nurse->gender }}</td>
                                            <td class="data2">{{ $nurse->address }}</td>
                                            <td class="data2">{{ $nurse->type }}</td>
                                            <td>{{$nurse->entity->name}}</td>
                                            <td class="data2">{{ $nurse->status }}</td>
                                            <td>
                                                <button id="restore" class="bg-green-500 text-sm text-white py-1 px-2 rounded-sm" data-id="{{$nurse->id}}">restore</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
        
        $('#restore').click(function(){
            var id = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('active_nurse_status', '') }}/${id}`,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.message == 'success') {
                                Swal.fire({
                                    title: 'Restored!',
                                    text: 'The nurse has been restored.',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    buttonsStyling: false,
                                    customClass: {
                                        confirmButton: 'custom-success-button'
                                    }
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue restoring the nurse.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was an issue restoring the nurse.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <script>
        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', () => {
                const modalId = button.getAttribute('data-modal');
                const modal = document.getElementById(modalId);
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('modal-enter-active');
                    modal.classList.remove('modal-enter');
                }, 10);
            });
        });

        document.querySelectorAll('.close').forEach(button => {
            button.addEventListener('click', () => {
                const modal = button.closest('.fixed');
                modal.classList.add('modal-leave-active');
                modal.classList.remove('modal-enter-active');
                modal.addEventListener('transitionend', () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('modal-leave-active');
                    modal.classList.add('modal-enter');
                }, {
                    once: true
                });
            });
        });
    </script>
</x-layout>
