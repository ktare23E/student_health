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
                        <h1 class="font-bold text-2xl">Student List</h1>
                    </div>
                    <div class="w-full flex justify-end px-6">
                        <button data-modal="modal1"
                            class="open-modal bg-blue-500 text-white px-4 py-2 rounded m-2">Create Student</button>
                    </div>
                    <div class="flex flex-row p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>Student LRN</th>
                                        <th>Student Name</th>
                                        <th>Grade Level</th>
                                        <th>School</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->student_lrn }}</td>
                                            <td>{{ $student->first_name.' '.$student->last_name }}</td>
                                            <td>{{ "Grade ".$student->grade_level }}</td>
                                            <td>{{ $student->school->name }}</td>
                                            <td>{{ $student->status }}</td>
                                            <td>
                                                <button
                                                    class="open-modal bg-orange-400 py-1 px-2 text-sm rounded-sm text-white"
                                                    data-modal="edit_modal" data-id="{{ $student->id }}"
                                                    data-student-lrn="{{ $student->student_lrn }}"
                                                    data-first-name="{{ $student->first_name }}"
                                                    data-last-name="{{ $student->last_name }}"
                                                    data-address="{{ $student->address }}"
                                                    data-grade="{{ $student->grade_level }}"
                                                    data-status="{{ $student->status }}">
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
        @include('components.modal.student_modal')

    </div>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });

        $('.create_student').click(function() {
            let first_name = $('#first_name').val();
            let last_name = $('#last_name').val();
            let address = $('#address').val();
            let student_lrn = $('#student_lrn').val();
            let status = $('#status').val();
            let grade_level = $('#grade_level').val();

            $.ajax({
                url: "{{ route('store_student') }}",
                type: "POST",
                data: {
                    first_name : first_name,
                    last_name : last_name,
                    address : address,
                    student_lrn : student_lrn,
                    status : status,
                    grade_level : grade_level,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message == 'success') {
                        alert('Student created successfully');
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
                    const first_name = button.getAttribute('data-first-name');
                    const last_name = button.getAttribute('data-last-name');
                    const address = button.getAttribute('data-address');
                    const student_lrn = button.getAttribute('data-student-lrn');
                    const grade_level = button.getAttribute('data-grade');
                    const status = button.getAttribute('data-status');

                    // Open the modal
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.classList.add('modal-enter-active');
                        modal.classList.remove('modal-enter');
                    }, 10);

                    // Fill the modal with data
                    $('#edit_first_name').val(first_name);
                    $('#edit_last_name').val(last_name);
                    $('#edit_address').val(address);
                    $('#edit_student_lrn').val(student_lrn);
                    $('#edit_grade_level').val(grade_level);
                    $('#edit_status').val(status);
                    $('#edit_student_id').val(id);
                    
                });
            });
        });

        $('.update_student').click(function() {
            let first_name = $('#edit_first_name').val();
            let last_name = $('#edit_last_name').val();
            let address = $('#edit_address').val();
            let student_lrn = $('#edit_student_lrn').val();
            let grade_level = $('#edit_grade_level').val();
            let status = $('#edit_status').val();
            let id = $('#edit_student_id').val();

            $.ajax({
                url: "{{ route('update_student') }}",
                type: "PATCH",
                data: {
                    first_name : first_name,
                    last_name : last_name,
                    address : address,
                    student_lrn : student_lrn,
                    grade_level : grade_level,
                    status : status,
                    id : id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.message == 'success') {
                        alert('Student updated successfully');
                        location.reload();
                    }
                }
            });
        });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
