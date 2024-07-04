<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->



    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            @include('components.sidebar')
            <div class="w-10/12 flex flex-col">
                <div>
                    <div class="flex flex-row">
                        <h1 class="font-bold text-2xl">Archive Student List</h1>
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
                                            <td class="text-red-500">{{ $student->status }}</td>
                                            <td>
                                                
                                                <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >view</button>
                                                <button  class="restore bg-green-500 text-sm text-white py-1 px-2 rounded-sm" data-id="{{$student->id}}">restore</button>
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
        

        $('.restore').click(function(){
            let student_id = $(this).data('id');

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
                            url: `{{ route('restore_student', '') }}/${student_id}`,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.message == 'success') {
                                    Swal.fire(
                                        'Restored!',
                                        'The student has been restored.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was an issue restoring the student.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue restoring the student.',
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
