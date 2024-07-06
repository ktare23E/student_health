<x-layout>
    <!-- source https://gist.github.com/dsursulino/369a0998c0fc8c25e19962bce729674f -->


    <div class="bg-blue-100 min-h-screen">
        @include('components.header')

        <div class="flex flex-row pt-24 px-10 pb-4">
            <div class="w-10/12 flex flex-col mx-auto">
                <div>

                    <nav class="bg-white p-4 rounded-md shadow-md w-full font-bold">
                        <ol class="list-reset flex text-gray-700">
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
                                <img src="{{ asset('imgs/default_profile.jpg') }}" alt="Profile Image"
                                    class="w-48 h-48 rounded-full object-cover">
                            </div>

                            <!-- Student Details -->
                            <div class="w-[70%] mx-auto grid grid-cols-3 gap-x-4 gap-y-4">
                                <!-- Name -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Name:</p>
                                    <p class="text-center">{{ $student->first_name . ' ' . $student->last_name }}</p>
                                </div>

                                <!-- Address -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Address:</p>
                                    <p class="text-center">{{ $student->address }}</p>
                                </div>

                                <!-- Status -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Status:</p>
                                    <p
                                        class="text-center capitalize {{ $student->status == 'active' ? 'text-green-500' : 'text-red-500' }}">
                                        {{ $student->status }}</p>
                                </div>

                                <!-- Grade Level -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">Grade Level:</p>
                                    <p class="text-center">{{ 'Grade ' . $student->grade_level }}</p>
                                </div>

                                <!-- School -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">School:</p>
                                    <p class="text-center">{{ $student->school->name }}</p>
                                </div>

                                <!-- School Address -->
                                <div class="flex flex-col items-center">
                                    <p class="font-semibold text-center">School Address:</p>
                                    <p class="text-center">{{ $student->school->address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-20 mb-8 w-full flex justify-end">
                            <button class="text-sm bg-blue-500 rounded-sm py-1 px-2 text-white">
                                <a href="{{route('checkup_student',$student->id)}}">+Checkup</a>    
                            </button>
                        </div>
                        <div
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-none">
                            <h1 class="font-semibold text-md mb-4">Student Checkup History</h1>

                            <!-- checkup Details -->
                            <!-- Checkup Details -->
                            <div class="space-y-4 flex flex-col items-center justify-center w-full">
                                <!-- Example Checkup Item -->
                                @forelse ($studentCheckUps[0]->checkups as $checkup)
                                    <div class="bg-gray-100 rounded-sm w-[70%] p-4 flex flex-col shadow-xl transition-all ease-in-out hover:shadow-none">
                                        <div class="flex justify-between items-center">
                                            @php


                                                $date = $checkup->date_of_checkup;
                                                $carbonDatetime = \Carbon\Carbon::parse($date);
                                                $formattedDate = $carbonDatetime->format('F j, Y');
                                                $formattedTime = $carbonDatetime->format('g:i A');

                                            @endphp
                                            <h2 class="font-bold text-md">Checkup Date: <span class="font-normal text-sm">{{$formattedDate.' '.$formattedTime}}</span></h2>
                                            <h1 class="font-semibold">School: <span class="font-normal text-sm">{{ $student->school->name }}</span></span></h1>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <h2 class="font-bold text-md">Nurse: <span class="font-normal tex-sm">{{$checkup->nurse->first_name.' '.$checkup->nurse->last_name}}</span></h2>
                                            <h1 class="font-semibold">Checkup Remarks: <span class="capitalize {{$checkup->remarks === 'Healthy' ? 'text-green-500':'text-red-500'}}">{{$checkup->remarks}}</span></h1>
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
                                                <p class="font-semibold text-center">Bllod Pressure:</p>
                                                <p class="text-center">{{ $checkup->systolic.'/'.$checkup->diastolic }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-6 w-full flex justify-center gap-2">
                                            <a href="{{route('edit_checkup',$checkup->id)}}" class="open-modal bg-orange-400 py-1 px-2 text-sm rounded-sm text-white">
                                                edit
                                            </a>
                                        <button class="text-sm py-1 px-2 rounded-sm bg-black text-white" >
                                            <a href="{{route('view_checkup',$checkup->id)}}">view</a>   
                                        </button>
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

    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
