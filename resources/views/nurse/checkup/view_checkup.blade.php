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

                    <div class="p-[2rem] w-full">
                        <div
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-none">
                            <h1 class="font-semibold text-md mb-4">Student Profile</h1>

                            <!-- Profile Image -->
                            <div class="flex justify-center mb-4">
                                <img src="{{ $student->student_profile === null ? asset('imgs/default_profile.jpg') :  asset('storage/'.$student->student_profile) }}" alt="Profile Image"
                                class="w-48 h-48 rounded-full object-cover">
                            </div>

                            <!-- Student Details -->
                            <div class="w-full mx-auto grid grid-cols-7 gap-x-4 gap-y-4">
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Name:</p>
                                    <p class="text-center">{{ $student->first_name . ' ' . $student->last_name }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Address:</p>
                                    <p class="text-center">{{ $student->address }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Parent/Guardian:</p>
                                    <p class="text-center">{{ $student->parent_name }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Cellphone Number:</p>
                                    <p class="text-center">{{ $student->cellphone_number }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Status:</p>
                                    <p class="text-center capitalize {{ $student->status == 'active' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $student->status }}
                                    </p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Grade Level:</p>
                                    <p class="text-center">{{ 'Grade ' . $student->grade_level }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">School:</p>
                                    <p class="text-center">{{ $student->school->name }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">School Address:</p>
                                    <p class="text-center">{{ $student->school->address }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">School Id:</p>
                                    <p class="text-center">{{ $student->school_id}}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Date of Birth:</p>
                                    <p class="text-center">{{ $student->date_of_birth }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Place of Birth:</p>
                                    <p class="text-center">{{ $student->birth_place }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">District:</p>
                                    <p class="text-center">{{ $student->school->district->name }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Division:</p>
                                    <p class="text-center">{{ $student->school->district->division->name }}</p>
                                </div>
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Region</p>
                                    <p class="text-center">{{ $student->region }}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h1 class="font-bold">Checkup Details:</h1>
                                <div class="w-[70%] mx-auto grid grid-cols-3 gap-x-4 gap-y-4">
                                    <!-- Name -->
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Nurse Conducted:</p>
                                        <p class="text-center">{{ $nurse->first_name . ' ' . $nurse->last_name }}</p>
                                    </div>
                                    @php
                                        $date = $checkup->date_of_checkup;
                                        $carbonDatetime = \Carbon\Carbon::parse($date);
                                        $formattedDate = $carbonDatetime->format('F j, Y');
                                        $formattedTime = $carbonDatetime->format('g:i A');
                                    @endphp
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Date of Checkup:</p>
                                        <p class="text-center">{{ $formattedDate.' '.$formattedTime }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Remarks:</p>
                                        <p
                                            class="text-center capitalize {{ $checkup->remarks == 'Healthy' ? 'text-green-500' : 'text-red-500' }}">
                                            {{ $checkup->remarks }}</p>
                                    </div>
                                    
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Adviser Name:</p>
                                        <p class="text-center">{{ $checkup->adviser_name}}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Student LRN:</p>
                                        <p class="text-center">{{ $checkup->student_lrn }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Temperature:</p>
                                    <p
                                        class="text-center">
                                        {{ $checkup->temperature }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Blood Pressure:</p>
                                        <p class="text-center">{{ $checkup->systolic.'/'.$checkup->diastolic }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Heart Rate:</p>
                                        <p class="text-center">{{ $checkup->heart_rate }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Pulse Rate:</p>
                                        <p class="text-center">{{ $checkup->pulse_rate }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Heart Rate:</p>
                                        <p class="text-center">{{ $checkup->respiratory_rate }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Height:</p>
                                        <p class="text-center">{{ $checkup->height }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Weight:</p>
                                        <p class="text-center">{{ $checkup->weight }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Height:</p>
                                        <p class="text-center">{{ $checkup->height }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">BMI Weight:</p>
                                        <p class="text-center">{{ $checkup->bmi_weight }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">BMI Height:</p>
                                        <p class="text-center">{{ $checkup->bmi_height }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Vision Screening:</p>
                                        <p class="text-center">{{ $checkup->vision_screening }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Auditory Screening:</p>
                                        <p class="text-center">{{ $checkup->auditory_screening }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Skin:</p>
                                        <p class="text-center">{{ $checkup->skin }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Scalp:</p>
                                        <p class="text-center">{{ $checkup->scalp }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Eyes:</p>
                                        <p class="text-center">{{ $checkup->eyes }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Ears:</p>
                                        <p class="text-center">{{ $checkup->ears }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Nose:</p>
                                        <p class="text-center">{{ $checkup->nose }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Eyes:</p>
                                        <p class="text-center">{{ $checkup->eyes }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Mouth/Throat/Neck:</p>
                                        <p class="text-center">{{ $checkup->mouth }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Lungs:</p>
                                        <p class="text-center">{{ $checkup->lungs }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Heart:</p>
                                        <p class="text-center">{{ $checkup->heart }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Abdomen:</p>
                                        <p class="text-center">{{ $checkup->abdomen }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Deformities:</p>
                                        <p class="text-center">{{ $checkup->deformities }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Iron Supplementation:</p>
                                        <p class="text-center">{{ $checkup->iron_supplementation }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Deworming:</p>
                                        <p class="text-center">{{ $checkup->deworming }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Immunization:</p>
                                        <p class="text-center">{{ $checkup->immunization }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">SBFP Benefeciary:</p>
                                        <p class="text-center">{{ $checkup->sbfp_beneficiary }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">4P's Beneficiary:</p>
                                        <p class="text-center">{{ $checkup->four_p_beneficiary }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <p class="font-semibold text-center">Menarche:</p>
                                        <p class="text-center">{{ $checkup->menarche }}</p>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
