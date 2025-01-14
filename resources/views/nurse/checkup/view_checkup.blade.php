<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->


    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            <div class="w-10/12 flex flex-col mx-auto">
                <div>

                    <nav class="bg-white p-4 rounded-md shadow-md w-full font-bold">
                        <ol class="list-reset flex text-gray-700">
                            @if (auth()->user()->type == 'school')
                                <li>
                                    <a href="{{ route('nurse_dashboard') }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="{{ route('student_list') }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Student</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="{{route('view_student',$checkup->student_id)}}" class="text-blue-600 hover:text-blue-800 hover:underline">Student
                                        Profile</a>
                                </li>
                            @elseif (auth()->user()->type == 'district')
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
                                    <a href="{{ route('view_school', ['school' => $school->id]) }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Student List</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="{{route('district_view_student',['student' => $student->id])}}" class="text-blue-600 hover:text-blue-800 hover:underline">Student
                                        Profile</a>
                                </li>
                            @elseif (auth()->user()->type == 'division')
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
                                    <a href="{{ route('division_view_school', ['school' => $school->id]) }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Student List</a>
                                </li>
                                <li>
                                    <span class="px-1">></span>
                                </li>
                                <li>
                                    <a href="{{route('division_view_student',['student' => $student->id])}}" class="text-blue-600 hover:text-blue-800 hover:underline">Student
                                        Profile</a>
                                </li>
                            @endif
                            <li>
                                <span class="px-1">></span>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Student
                                    View Checkup</a>
                            </li>
                        </ol>
                    </nav>
                    <div class="p-6 w-full">
                        <div class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-lg hover:shadow-md transition-shadow">
                            <!-- Header -->
                            <div class="text-center mb-6">
                                <h1 class="font-bold text-xl mb-2">Student Profile</h1>
                                <div class="flex justify-center">
                                    <img src="{{ $student->student_profile === null ? asset('imgs/default_profile.jpg') :  asset('storage/'.$student->student_profile) }}"
                                         alt="Profile Image" 
                                         class="w-32 h-32 rounded-full object-cover shadow">
                                </div>
                            </div>
                    
                            <!-- Student Details -->
                            <div class="grid grid-cols-2 gap-6 mb-6">
                                <div>
                                    <h2 class="font-semibold text-lg border-b pb-2 mb-4">Personal Information</h2>
                                    <ul class="space-y-2">
                                        <li><strong>Name:</strong> {{ $student->first_name . ' ' . $student->last_name }}</li>
                                        <li><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</li>
                                        <li><strong>Place of Birth:</strong> {{ $student->birth_place }}</li>
                                        <li><strong>Address:</strong> {{ $student->address }}</li>
                                        <li><strong>Parent/Guardian:</strong> {{ $student->parent_name }}</li>
                                        <li><strong>Cellphone Number:</strong> {{ $student->cellphone_number }}</li>
                                    </ul>
                                </div>
                                <div>
                                    <h2 class="font-semibold text-lg border-b pb-2 mb-4">School Details</h2>
                                    <ul class="space-y-2">
                                        <li><strong>School:</strong> {{ $student->school->name }}</li>
                                        <li><strong>School Address:</strong> {{ $student->school->address }}</li>
                                        <li><strong>Grade Level:</strong> Grade {{ $student->grade_level }}</li>
                                        <li><strong>District:</strong> {{ $student->school->district->name }}</li>
                                        <li><strong>Division:</strong> {{ $student->school->district->division->name }}</li>
                                        <li><strong>Region:</strong> {{ $student->region }}</li>
                                    </ul>
                                </div>
                            </div>
                    
                            <!-- Checkup Details -->
                            <div class="bg-gray-50 rounded-md p-4">
                                <h2 class="font-semibold text-lg border-b pb-2 mb-4">Checkup Details</h2>
                                <div class="grid grid-cols-3 gap-4">
                                    @php
                                        $date = $checkup->date_of_checkup;
                                        $carbonDatetime = \Carbon\Carbon::parse($date);
                                        $formattedDate = $carbonDatetime->format('F j, Y');
                                        $formattedTime = $carbonDatetime->format('g:i A');
                                    @endphp
                                    <div><strong>Nurse Conducted:</strong> {{ $nurse->first_name . ' ' . $nurse->last_name }}</div>
                                    <div><strong>Date of Checkup:</strong> {{ $formattedDate . ' ' . $formattedTime }}</div>
                                    <div><strong>Remarks:</strong> 
                                        <span class="{{ $checkup->remarks == 'Healthy' ? 'text-green-500' : 'text-red-500' }}">
                                            {{ $checkup->remarks }}
                                        </span>
                                    </div>
                                    <div><strong>Adviser Name:</strong> {{ $checkup->adviser_name }}</div>
                                    <div><strong>Temperature:</strong> {{ $checkup->temperature }}</div>
                                    <div><strong>Blood Pressure:</strong> {{ $checkup->systolic }}/{{ $checkup->diastolic }}</div>
                                    <div><strong>Heart Rate:</strong> {{ $checkup->heart_rate }}</div>
                                    <div><strong>Height:</strong> {{ $checkup->height }}</div>
                                    <div><strong>Weight:</strong> {{ $checkup->weight }}</div>
                                    <div><strong>Vision Screening:</strong> {{ $checkup->vision_screening }}</div>
                                    <div><strong>Iron Supplementation:</strong> {{ $checkup->iron_supplementation }}</div>
                                    <div><strong>Immunization:</strong> {{ $checkup->immunization }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</x-layout>
