<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->


    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            <div class="w-10/12 flex flex-col mx-auto">
                <div>

                    <nav class="bg-white p-4 rounded-md shadow-md w-full font-bold">
                        @if (auth()->user()->type === 'district')
                            <ol class="list-reset flex text-gray-700">
                                <li>
                                    <a href="{{ route('district_nurse_dashboard') }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="{{ route('school_list') }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">School</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Student</a>
                                </li>
                            </ol>
                        @else
                            <ol class="list-reset flex text-gray-700">
                                <li>
                                    <a href="{{ route('division_nurse_dashboard') }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="{{ route('division_school_list') }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">School</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Student</a>
                                </li>
                            </ol>
                        @endif
                        
                    </nav>

                    <div class="p-[2rem] w-full">
                        <div
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-none">
                            <h1 class="font-semibold text-md mb-4">Student List</h1>
                            <!-- Student Details -->
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
                                            <td class="text-green-500 capitalize">{{ $student->status }}</td>
                                            <td>
                                                @if (auth()->user()->type === 'district')
                                                    <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >
                                                        <a href="{{route('district_view_student',$student->id)}}">view</a>   
                                                    </button>
                                                @else
                                                    <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >
                                                        <a href="{{route('division_view_student',$student->id)}}">view</a>   
                                                    </button>
                                                @endif
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
        
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
