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
                                    <a href="{{ route('view_school', ['school' => $studentSchool->id]) }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Student List</a>
                                </li>
                            @else
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
                                    <a href="{{ route('division_view_school', ['school' => $studentSchool->id]) }}"
                                        class="text-blue-600 hover:text-blue-800 hover:underline">Student List</a>
                                </li>
                            @endif

                            <li>
                                <span class="px-1">></span>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Student
                                    Profile</a>
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
                            <div class="w-full flex justify-center px-6">
                                <button id="toggle-upload" class="bg-black text-white text-sm px-4 py-2 rounded m-2">Change Profile</button>
                                <form class="flex items-center justify-center" method="POST" action="{{ route('student_profile', $student->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <input id="student_profile" type="file" name="student_profile" class="hidden mt-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-teal-500 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-teal-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                                    <button id="upload-btn" type="submit" class="hidden bg-green-500 text-white text-sm px-4 py-2 rounded m-2">Upload</button>
                                </form>
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
                        </div>
                        <div class="mt-20 mb-8 w-full flex justify-end">
                            @if (auth()->user()->type == 'school')
                                <button class="text-sm bg-blue-500 rounded-sm py-1 px-2 text-white">
                                    <a href="{{ route('checkup_student', $student->id) }}">+Checkup</a>
                                </button>
                            @endif
                        </div>
                        <div
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-none">
                            <h1 class="font-semibold text-md mb-4">Student Checkup History</h1>

                            <!-- Checkup Details -->
                            <div class="space-y-4 flex flex-col items-center justify-center w-full">
                                <!-- Example Checkup Item -->
                                @forelse ($studentCheckUps[0]->checkups as $checkup)
                                    <div
                                        class="bg-gray-100 rounded-sm w-[70%] p-4 flex flex-col shadow-xl transition-all ease-in-out hover:shadow-none">
                                        <div class="flex justify-between items-center">
                                            @php

                                                $date = $checkup->date_of_checkup;
                                                $carbonDatetime = \Carbon\Carbon::parse($date);
                                                $formattedDate = $carbonDatetime->format('F j, Y');
                                                $formattedTime = $carbonDatetime->format('g:i A');

                                            @endphp
                                            <h2 class="font-bold text-md">Checkup Date: <span
                                                    class="font-normal text-sm">{{ $formattedDate . ' ' . $formattedTime }}</span>
                                            </h2>
                                            <h1 class="font-semibold">School: <span
                                                    class="font-normal text-sm">{{ $student->school->name }}</span></span>
                                            </h1>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <h2 class="font-bold text-md">Nurse: <span
                                                    class="font-normal tex-sm">{{ $checkup->nurse->first_name . ' ' . $checkup->nurse->last_name }}</span>
                                            </h2>
                                            <h1 class="font-semibold">Checkup Remarks: <span
                                                    class="capitalize {{ $checkup->remarks === 'Healthy' ? 'text-green-500' : 'text-red-500' }}">{{ $checkup->remarks }}</span>
                                            </h1>
                                        </div>
                                        <h1 class="font-semibold mt-4">Checkup Details:</h1>
                                        <div class="w-full grid grid-cols-3 gap-4">
                                            <div class="flex flex-col items-center">
                                                <p class="font-bold text-center">Height:</p>
                                                <p class="text-center">{{ $checkup->height }}</p>
                                            </div>
                                            <div class="flex flex-col items-center">
                                                <p class="font-bold text-center">BMI:</p>
                                                <p class="text-center">{{ $checkup->bmi_weight }}</p>
                                            </div>
                                            <div class="flex flex-col items-center">
                                                <p class="font-semibold text-center">Blood Pressure:</p>
                                                <p class="text-center">{{ $checkup->systolic . '/' . $checkup->diastolic }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-6 w-full flex justify-center gap-2">
                                            @if (auth()->user()->type == 'school')
                                                <a href="{{ route('edit_checkup', $checkup->id) }}"
                                                    class="open-modal bg-orange-400 py-1 px-2 text-sm rounded-sm text-white">
                                                    edit
                                                </a>
                                            @endif
                                            <button class="text-sm py-1 px-2 rounded-sm bg-black text-white">
                                                @if (auth()->user()->type == 'school')
                                                    <a href="{{ route('view_checkup', $checkup->id) }}">view</a>
                                                @elseif (auth()->user()->type == 'district')
                                                    <a
                                                        href="{{ route('district_view_checkup', $checkup->id) }}">view</a>
                                                @else
                                                    <a
                                                        href="{{ route('division_view_checkup', $checkup->id) }}">view</a>
                                                @endif

                                            </button>
                                            <a href="{{route('test_checkup',$checkup->id)}}" class="text-sm py-1 px-2 rounded-sm bg-blue-500 text-white">check</a>
                                        </div>
                                    </div>
                                @empty
                                    <h1>No checkup yet.</h1>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#toggle-upload').on('click', function() {
                $('#student_profile').click();
            });

            $('#student_profile').on('change', function() {
                if (this.files.length > 0) {
                    $('#toggle-upload').hide(); // Hide the "Change Profile" button
                    $('#student_profile').removeClass('hidden').addClass('block'); // Show the file input
                    $('#upload-btn').removeClass('hidden').addClass('block'); // Show the "Upload" button
                }
            });
        });
    </script>
</x-layout>
