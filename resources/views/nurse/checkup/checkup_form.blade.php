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
                                <a href="{{route('view_student',$student->id)}}" class="text-blue-600 hover:text-blue-800 hover:underline">Student
                                    Profile</a>
                            </li>
                            <li>
                                <span class="px-1">></span>
                            </li>
                            <li>
                                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">
                                    Checkup Form</a>
                            </li>
                        </ol>
                    </nav>

                    <div class="p-[2rem] w-full">
                        <div
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-none">
                            <h1 class="font-semibold text-md mb-4">Checkup Form</h1>

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
                        
                        
                    </div>

                </div>
            </div>
        </div>
        @include('components.modal.student_modal')

    </div>

    <script></script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
