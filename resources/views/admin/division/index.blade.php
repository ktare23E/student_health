<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->

    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet" />

    <div class="bg-blue-100 min-h-screen">
        <div class="fixed bg-white text-blue-800 px-10 py-1 z-10 w-full">
            <div class="flex items-center justify-between py-2 text-5x1">
                <div class="font-bold text-blue-900 text-xl">Admin<span class="text-orange-600">Panel</span></div>
                <div class="flex items-center text-gray-500">
                    <div class="bg-center bg-cover bg-no-repeat rounded-full inline-block h-12 w-12 ml-2"
                        style="background-image: url('{{ asset('imgs/deped_logo.png') }}');">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">Division List</h1>
                    </div>
                    <div class="w-full flex justify-end px-6">
                        <button data-modal="modal1"
                            class="open-modal bg-blue-500 text-white px-4 py-2 rounded m-2">Create Division</button>
                    </div>
                    <div class="flex flex-row p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>Division Name</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($divisions as $division)
                                        <tr>
                                            <td class="data1">{{ $division->name }}</td>
                                            <td class="data2">{{ $division->address }}</td>
                                            <td>
                                                <button
                                                    class="open-modal bg-orange-400 py-1 px-2 text-sm rounded-sm text-white"
                                                    data-modal="edit_modal" data-id="{{ $division->id }}"
                                                    data-name="{{ $division->name }}"
                                                    data-address="{{ $division->address }}">
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
        @include('components.modal.modal_test')

    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });

        $('.create_division').click(function() {
            var name = $('#name').val();
            var address = $('#address').val();

            $.ajax({
                url: "{{ route('store_division') }}",
                type: "POST",
                data: {
                    name: name,
                    address: address,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message == 'success') {
                        alert('Division created successfully');
                        location.reload();
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

                    // Open the modal
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.add('modal-enter-active');
                        modal.classList.remove('modal-enter');
                    }, 10);

                    // Fill the modal with data
                    $('#edit_name').val(name);
                    $('#edit_address').val(address);
                    $('#edit_division_id').val(id);
                    
                });
            });
        });

        $('.update_division').click(function() {
            var name = $('#edit_name').val();
            var address = $('#edit_address').val();
            var id = $('#edit_division_id').val();  
        
            $.ajax({
                url: "{{ route('update_division') }}",
                type: "PATCH",
                data: {
                    name: name,
                    address: address,
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message == 'success') {
                        alert('Division updated successfully');
                        location.reload();
                    }
                }
            });
        });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
