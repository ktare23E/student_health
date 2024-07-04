<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->


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
                        <button id="toggle-upload" class="bg-blue-500 text-white text-sm px-4 py-2 rounded m-2">Register Student Via .csv</button>
                        <form class="flex items-center justify-center" method="POST" action="{{route('import_student')}}" enctype="multipart/form-data">
                            @csrf
                            <input id="file-input" type="file" name="file" accept=".csv" class="hidden mt-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                            <button id="upload-btn" type="submit" class="hidden bg-green-500 text-white text-sm px-4 py-2 rounded m-2">Upload</button>
                        </form>
                        
                        <button data-modal="modal1" class="open-modal bg-blue-500 text-sm text-white px-4 py-2 rounded m-2">Create Student</button>
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
                                        <tr class="text-sm">
                                            <td>{{ $student->student_lrn }}</td>
                                            <td>{{ $student->first_name.' '.$student->last_name }}</td>
                                            <td>{{ "Grade ".$student->grade_level }}</td>
                                            <td>{{ $student->school->name }}</td>
                                            <td class="text-green-500">{{ $student->status }}</td>
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
                                                <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >
                                                    <a href="{{route('view_student',$student->id)}}">view</a>   
                                                </button>
                                                <button class="archive bg-blue-500 text-sm text-white py-1 px-2 rounded-sm" data-id="{{$student->id}}">archive</button>
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
        

        $(document).ready(function() {
            $('#toggle-upload').on('click', function() {
                $('#file-input').click();
            });

            $('#file-input').on('change', function() {
                if (this.files.length > 0) {
                    $('#toggle-upload').hide(); // Hide the "Register Student Via .csv" button
                    $('#file-input').removeClass('hidden').addClass('block'); // Show the file input
                    $('#upload-btn').removeClass('hidden').addClass('block'); // Show the "Upload" button
                }
            });
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

        $('.archive').click(function(){
            let student_id = $(this).data('id');

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
                            url: `{{ route('update_student_status', '') }}/${student_id}`,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.message == 'success') {
                                    Swal.fire(
                                        'Archived!',
                                        'The student has been archived.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was an issue archiving the student.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue archiving the student.',
                                    'error'
                                );
                            }
                        });
                    }
                });
        });

    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
