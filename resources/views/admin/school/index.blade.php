<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->

    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet" />

    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">School List</h1>
                    </div>
                    <div class="w-full flex justify-end px-6">
                        <button data-modal="modal1"
                            class="open-modal bg-blue-500 text-white px-4 py-2 rounded m-2">Create School</button>
                    </div>
                    <div class="flex flex-row p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>School Name</th>
                                        <th>Address</th>
                                        <th>District</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schools as $school)
                                        <tr>
                                            <td class="data1">{{ $school->name }}</td>
                                            <td class="data2">{{ $school->address }}</td>
                                            <td class="data2">{{ $school->district->name }}</td>
                                            <td class="data2">{{ $school->status }}</td>
                                            <td>
                                                <button
                                                    class="open-modal bg-orange-400 py-1 px-2 text-sm rounded-sm text-white"
                                                    data-modal="edit_modal" data-id="{{ $school->id }}"
                                                    data-name="{{ $school->name }}"
                                                    data-address="{{ $school->address }}"
                                                    data-division="{{$school->district->id}}">
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
        @include('components.modal.school_modal')

    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });

        $('.create_district').click(function() {
            var name = $('#name').val();
            var address = $('#address').val();
            var division_id = $('#division_id').val();

            $.ajax({
                url: "{{ route('store_district') }}",
                type: "POST",
                data: {
                    name: name,
                    address: address,
                    division_id: division_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    if (response.message == 'success') {
                        alert('District created successfully');
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
                    $('#edit_division_id').val(divistion_id);
                    $('#edit_district_id').val(id);
                    
                });
            });
        });

        $('.update_district').click(function() {
            var name = $('#edit_name').val();
            var address = $('#edit_address').val();
            let divistion_id = $('#edit_division_id').val();
            let id = $('#edit_district_id').val();
        
            $.ajax({
                url: "{{ route('update_district') }}",
                type: "PATCH",
                data: {
                    name: name,
                    address: address,
                    division_id: divistion_id,
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
