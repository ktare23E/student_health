<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->



    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">District List</h1>
                    </div>
                    <div class="w-full flex justify-end px-6">
                        <button data-modal="modal1"
                            class="open-modal bg-blue-500 text-white px-4 py-2 rounded m-2">Create District</button>
                    </div>
                    <div class="flex flex-row p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr class="text-sm">
                                        <th>District Name</th>
                                        <th>Address</th>
                                        <th>District Head</th>
                                        <th>Under of Division</th>  
                                        {{-- <th>Nurse Assigned</th>   --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($districts as $district)
                                        <tr class="text-sm">
                                            <td class="data1">{{ $district->name }}</td>
                                            <td class="data2">{{ $district->address }}</td>
                                            <td class="data2">{{ $district->district_head }}</td>
                                            <td class="data2">{{ $district->division->name }}</td>
                                            {{-- @if ($district->nurses->count() === 0)
                                                <td>No nurse assigned yet</td>
                                            @else
                                                <td class="data2">{{ $district->nurses->last()->first_name.' '. $district->nurses->first()->last_name }}</td>
                                            @endif --}}
                                            <td>
                                                <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >
                                                    <a href="{{route('district_view_school_list2',$district->id)}}">view school</a>   
                                                </button>
                                                <button
                                                    class="open-modal bg-orange-400 py-1 px-2 text-sm rounded-sm text-white"
                                                    data-modal="edit_modal" data-id="{{ $district->id }}"
                                                    data-name="{{ $district->name }}"
                                                    data-address="{{ $district->address }}"
                                                    data-district-head="{{ $district->district_head }}"
                                                    data-division="{{$district->division->id}}">
                                                    edit
                                                </button>
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
        @include('components.modal.district_modal')

    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });

        $('.create_district').click(function() {
            var name = $('#name').val();
            var address = $('#address').val();
            var division_id = $('#division_id').val();
            let district_head = $('#district_head').val();

            $.ajax({
                url: "{{ route('store_district') }}",
                type: "POST",
                data: {
                    name: name,
                    address: address,
                    district_head: district_head,
                    division_id: division_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    if (response.message == 'success') {
                        Swal.fire({
                            title: "Success!",
                            text: "Sucessfully Created District",
                            icon: "success",
                            confirmButtonText: 'OK',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'custom-confirm-button'
                            }
                        }).then(function(){
                            location.reload();
                        });
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', (event) => {
                    const button = event.currentTarget;
                    const modalId = button.getAttribute('data-modal');
                    const modal = document.getElementById(modalId);
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const address = button.getAttribute('data-address');
                    const district_head = button.getAttribute('data-district-head');
                    const divistion_id = button.getAttribute('data-division');


                    // Open the modal
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.add('modal-enter-active');
                        modal.classList.remove('modal-enter');
                    }, 10);

                    // Fill the modal with data
                    $('#edit_name').val(name);
                    $('#edit_address').val(address);
                    $('#edit_district_head').val(district_head);
                    $('#edit_division_id').val(divistion_id);
                    $('#edit_district_id').val(id);
                    
                });
            });
        });

        $('.update_district').click(function() {
            var name = $('#edit_name').val();
            var address = $('#edit_address').val();
            let district_head = $('#edit_district_head').val();
            let divistion_id = $('#edit_division_id').val();
            let id = $('#edit_district_id').val();
            
            $.ajax({
                url: "{{ route('update_district') }}",
                type: "PATCH",
                data: {
                    name: name,
                    address: address,
                    district_head : district_head,
                    division_id: divistion_id,
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message == 'success') {
                        Swal.fire({
                            title: "Success!",
                            text: "Sucessfully Updated District",
                            icon: "success",
                            confirmButtonText: 'OK',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'custom-confirm-button'
                            }
                        }).then(function(){
                            location.reload();
                        });
                    }
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
