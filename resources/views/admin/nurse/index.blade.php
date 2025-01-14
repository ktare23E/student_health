<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->



    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">List of Nurse</h1>
                    </div>
                    <div class="w-full flex justify-end px-6">
                        <button data-modal="modal1" class="open-modal bg-blue-500 text-white px-4 py-2 rounded m-2">Create
                            Nurse</button>
                    </div>
                    <div class="flex flex-row p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        {{-- <th>Gender</th> --}}
                                        {{-- <th>Address</th> --}}
                                        <th>Nurse Type</th>
                                        {{-- <th>Assigned To</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nurses as $nurse)
                                        <tr>
                                            <td class="data1">{{ $nurse->last_name }}</td>
                                            <td class="data2">{{ $nurse->first_name }}</td>
                                            {{-- <td class="data2">{{ $nurse->gender }}</td> --}}
                                            {{-- <td class="data2">{{ $nurse->address }}</td> --}}
                                            <td class="capitalize">{{ $nurse->type }}</td>
                                            {{-- <td>{{$nurse->entity->name}}</td> --}}
                                            <td class="capitalize text-green-500">{{ $nurse->status }}</td>
                                            <td>
                                                <button
                                                    class="open-modal bg-orange-400 py-1 px-2 text-sm rounded-sm text-white"
                                                    data-modal="edit_modal" data-id="{{ $nurse->id }}"
                                                    data-first-name="{{ $nurse->first_name }}"
                                                    data-middle-name="{{ $nurse->middle_name }}"
                                                    data-last-name="{{ $nurse->last_name }}"
                                                    data-gender="{{ $nurse->gender }}"
                                                    data-address="{{ $nurse->address }}"
                                                    data-email="{{ $nurse->email }}" data-type="{{ $nurse->type }}"
                                                    data-status="{{ $nurse->status }}"
                                                    data-entity="{{ $nurse->entity->id }}">
                                                    edit
                                                </button>
                                                <button id="reset"
                                                    class="text-sm py-1 px-2 rounded-sm bg-red-600 text-white"
                                                    data-id="{{ $nurse->id }}">reset</button>
                                                <button 
                                                    class="archive bg-blue-500 text-sm text-white py-1 px-2 rounded-sm"
                                                    data-id="{{ $nurse->id }}">archive</button>
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
        @include('components.modal.nurse_modal')

    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });

        document.addEventListener('DOMContentLoaded', function() {
            var nurseTypeSelect = document.getElementById('type');
            var entityIdSelect = document.getElementById('entity_id');
            var entityIdDiv = document.getElementById('entity_id_div');

            nurseTypeSelect.addEventListener('change', function() {
                var selectedType = nurseTypeSelect.value;
                entityIdSelect.innerHTML = ''; // Clear previous options

                if (selectedType) {
                    // Fetch entities based on selected type
                    var url = "{{ route('api.entities', ['type' => ':type']) }}";
                    url = url.replace(':type', selectedType);
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            entityIdSelect.innerHTML = '<option value="">Select Entity</option>';
                            data.forEach(entity => {
                                console.log(entity);
                                var option = document.createElement('option');
                                option.value = entity.id;
                                option.textContent = entity.name;
                                entityIdSelect.appendChild(option);
                            });
                        });
                } else {
                    entityIdDiv.style.display = 'none'; // Hide if no type is selected
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var nurseTypeSelect = document.getElementById('edit_type');
            var entityIdSelect = document.getElementById('edit_entity_id');
            var entityIdDiv = document.getElementById('entity_id_div');

            nurseTypeSelect.addEventListener('change', function() {
                var selectedType = nurseTypeSelect.value;
                entityIdSelect.innerHTML = ''; // Clear previous options

                if (selectedType) {
                    // Fetch entities based on selected type
                    var url = "{{ route('api.entities', ['type' => ':type']) }}";
                    url = url.replace(':type', selectedType);
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            entityIdSelect.innerHTML = '<option value="">Select Entity</option>';
                            data.forEach(entity => {
                                var option = document.createElement('option');
                                option.value = entity.id;
                                option.textContent = entity.name;
                                entityIdSelect.appendChild(option);
                            });
                        });
                } else {
                    entityIdDiv.style.display = 'none'; // Hide if no type is selected
                }
            });
        });

        $('.create_nurse').click(function() {
            var first_name = $('#first_name').val();
            var middle_name = $('#middle_name').val();
            var last_name = $('#last_name').val();
            var address = $('#address').val();
            var gender = $('#gender').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var type = $('#type').val();
            var entity_id = $('#entity_id').val();
            var status = $('#status').val();

            $.ajax({
                url: "{{ route('store_nurse') }}",
                type: "POST",
                data: {
                    first_name: first_name,
                    middle_name: middle_name,
                    last_name: last_name,
                    address: address,
                    gender: gender,
                    email: email,
                    password: password,
                    type: type,
                    entity_id: entity_id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // console.log(response);
                    if (response.message == 'success') {
                        Swal.fire({
                            title: "Success!",
                            text: "Sucessfully Created Nurse",
                            icon: "success",
                            confirmButtonText: 'OK',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'custom-confirm-button'
                            }
                        }).then(function() {
                            location.reload();
                        });
                    }
                }
            });
        });

        $('.archive').click(function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, archive it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('update_nurse_status', '') }}/${id}`,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.message == 'success') {
                                Swal.fire({
                                    title: 'Archived!',
                                    text: 'The nurse has been archived.',
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
                                    'There was an issue archiving the nurse.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was an issue archiving the nurse.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        $('#reset').click(function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('reset_nurse_password', '') }}/${id}`,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.message == 'success') {
                                Swal.fire({
                                    title: 'Password Reset!',
                                    text: 'The nurse password has been reset.',
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
                                    'There was an issue resetting the nurse password.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was an issue resetting the nurse password.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = passwordInput.nextElementSibling;
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', (event) => {
                    const button = event.currentTarget;
                    const modalId = button.getAttribute('data-modal');
                    const modal = document.getElementById(modalId);
                    const id = button.getAttribute('data-id');
                    const first_name = button.getAttribute('data-first-name');
                    const middle_name = button.getAttribute('data-middle-name');
                    const last_name = button.getAttribute('data-last-name');
                    const address = button.getAttribute('data-address');
                    const status = button.getAttribute('data-status');
                    const gender = button.getAttribute('data-gender');
                    const email = button.getAttribute('data-email');
                    const type = button.getAttribute('data-type');
                    const entity = button.getAttribute('data-entity');
                    var entityIdSelect = document.getElementById('edit_entity_id');
                    console.log(entity);

                    // Open the modal
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.add('modal-enter-active');
                        modal.classList.remove('modal-enter');
                    }, 10);

                    //check type and append entity
                    if (type) {
                        var url = "{{ route('api.entities', ['type' => ':type']) }}";
                        url = url.replace(':type', type);
                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(entity => {
                                    if (entity.id == entity) {
                                        var option = document.createElement('option');
                                        option.value = entity.id;
                                        option.textContent = entity.name;
                                        option.selected = true;
                                        entityIdSelect.appendChild(option);
                                    } else {
                                        var option = document.createElement('option');
                                        option.value = entity.id;
                                        option.textContent = entity.name;
                                        entityIdSelect.appendChild(option);
                                    }
                                });
                            });
                    }

                    // Fill the modal with data
                    $('#edit_first_name').val(first_name);
                    $('#edit_middle_name').val(middle_name);
                    $('#edit_last_name').val(last_name);
                    $('#edit_address').val(address);
                    $('#edit_status').val(status);
                    $('#edit_gender').val(gender);
                    $('#edit_email').val(email);
                    $('#edit_type').val(type);
                    $('#edit_entity_id').val(entity);
                    $('#edit_nurse_id').val(id);

                });
            });
        });

        $('.update_nurse').click(function() {
            let first_name = $('#edit_first_name').val();
            let middle_name = $('#edit_middle_name').val();
            let last_name = $('#edit_last_name').val();
            let address = $('#edit_address').val();
            let status = $('#edit_status').val();
            let gender = $('#edit_gender').val();
            let email = $('#edit_email').val();
            let type = $('#edit_type').val();
            let entity_id = $('#edit_entity_id').val();
            let id = $('#edit_nurse_id').val();

            $.ajax({
                url: "{{ route('update_nurse') }}",
                type: "PATCH",
                data: {
                    first_name: first_name,
                    middle_name: middle_name,
                    last_name: last_name,
                    address: address,
                    status: status,
                    gender: gender,
                    email: email,
                    type: type,
                    entity_id: id,
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message == 'success') {
                        Swal.fire({
                            title: "Success!",
                            text: "Sucessfully Updated Nurse",
                            icon: "success",
                            confirmButtonText: 'OK',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'custom-confirm-button'
                            }
                        }).then(function() {
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
