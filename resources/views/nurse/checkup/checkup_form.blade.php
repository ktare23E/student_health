<x-layout>
    <!-- source https://gist.github.com/dsursuliNo/369a0998c0fc8c25e19962bce729674f -->


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
                            class="bg-white rounded-md px-6 py-4 w-full mx-auto shadow-2xl transition-all hover:shadow-None">
                            <h1 class="font-semibold text-md mb-4">Checkup Form</h1>
                            <x-forms.form action="{{route('store_checkup',$student->id)}}" method="POST">
                                <div class="w-[70%] mx-auto space-y-2">
                                    {{-- <div class="grid grid-cols-3 gap-3 ">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                                            <input type="date" id="date_of_birth" name="date_of_birth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Place</label>
                                            <input type="text" id="birth_place" name="birth_place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Birth Place" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent/Guardian Name</label>
                                            <input type="text" id="parent_name" name="parent_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mrs. Jane Doe" required />
                                        </div>
                                    </div> --}}
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                            <input type="text" id="student_age" name="student_age" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="12 years old" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adviser Name</label>
                                            <input type="text" id="adviser_name" name="adviser_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Adviser Name" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Temperature</label>
                                            <input type="text" id="temperature" name="temperature" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="35.00" required />
                                        </div>
                                        {{-- <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School Id</label>
                                            <input type="text" id="school_id" name="school_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="School ID" required />
                                        </div> --}}
                                    
                                    </div> 
                                    {{-- <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region</label>
                                            <input type="text" id="region" name="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Region" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                                            <input type="text" id="division" name="division" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Division" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone/Cellphone</label>
                                            <input type="text" id="telephone_no" name="telephone_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+639 3213 3213" required />
                                        </div>
                                    </div> --}}
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Systolic</label>
                                            <input type="text" id="systolic" name="systolic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="120" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diastolic</label>
                                            <input type="text" id="diastolic" name="diastolic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="80" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart Rate</label>
                                            <input type="text" id="heart_rate" name="heart_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="72" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pulse Rate</label>
                                            <input type="text" id="pulse_rate" name="pulse_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="60" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Respiratory Rate</label>
                                            <input type="text" id="respiratory_rate" name="respiratory_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="20" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Height(cm)</label>
                                            <input type="text" id="height" name="height" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="160.50 cm" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Weight(kg)</label>
                                            <input type="text" id="weight" name="weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="55.75 kg" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Nutritional Status (BMI/Wt-for-Age)</label>
                                            <select id="bmi_weight" name="bmi_weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal Weight">Normal Weight</option>
                                                <option value="Wasted Underweight">Wasted Underweight</option>
                                                <option value="Severely Wasted Underweight">Severely Wasted Underweight</option>
                                                <option value="Overweight">Overweight</option>
                                                <option value="Obese">Obese</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Nutritional Status (Height-for-Age)</label>
                                            <select id="bmi_height" name="bmi_height" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal Height">Normal Height</option>
                                                <option value="Stunted">Stunted</option>
                                                <option value="Serverly Stunted">Serverly Stunted</option>
                                                <option value="Tall">Tall</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision Screening</label>
                                            <select id="vision_screening" name="vision_screening" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Passed">Passed</option>
                                                <option value="Failed">Failed</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Audiitory Screening</label>
                                            <select id="auditory_screening" name="auditory_screening" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Passed">Passed</option>
                                                <option value="Failed">Failed</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skin</label>
                                            <select id="skin" name="skin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Redness of Skin">Redness of Skin</option>
                                                <option value="White Spots">White Spots</option>
                                                <option value="Impetigo/Boil">Impetigo/Boil</option>
                                                <option value="Bruises/Injuries">Bruises/Injuries</option>
                                                <option value="Skin Lessions">Skin Lessions</option>
                                                <option value="Itchiness">Itchiness</option>
                                                <option value="Acne/Pimple">Acne/Pimple</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scalp</label>
                                            <select id="scalp" name="scalp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Presence of Lice">Presence of Lice</option>
                                                <option value="Itchiness">Itchiness</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">EYes</label>
                                            <select id="eyes" name="eyes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Stye">Stye</option>
                                                <option value="Eye Redness">Eye Redness</option>
                                                <option value="Ocular Misallignment">Ocular Misallignment</option>
                                                <option value="Pale Conjunctiva">Pale Conjunctiva</option>
                                                <option value="Eye Discharge">Eye Discharge</option>
                                                <option value="Matted Eyelashes">Matted Eyelashes</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ear</label>
                                            <select id="ears" name="ears" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Ear Discharge">Ear Discharge</option>
                                                <option value="Impacted Cerumen">Impacted Cerumen</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nose</label>
                                            <select id="nose" name="nose" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Mucus Discharge">Mucus Discharge</option>
                                                <option value="Nose Bleeding(Eplstaxis)">Nose Bleeding(Eplstaxis)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mouth/Neck/Throat</label>
                                            <select id="mouth" name="mouth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Enlarge Tonsils">Enlarge Tonsils</option>
                                                <option value="Presence of Lesions">Presence of Lesions</option>
                                                <option value="Inflamed Pharynx">Inflamed Pharynx</option>
                                                <option value="Enlarge LymphNodes">Enlarge LymphNodes</option>
                                                <option value="others">Others, specify</option>
                                            </select>
                                            <input type="hidden" id="othersInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lungs</label>
                                            <select id="lungs" name="lungs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Rales">Rales</option>
                                                <option value="Wheeze">Wheeze</option>
                                                <option value="others">Others</option>
                                            </select>
                                            <input type="hidden"   id="othersInput2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart</label>
                                            <select id="heart" name="heart" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Murmur">Murmur</option>
                                                <option value="Irregular Heart Rate">Irregular Heart Rate</option>
                                                <option value="others">Others</option>
                                            </select>
                                            <input type="hidden"   id="othersInput3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abdomen</label>
                                            <select id="abdomen" name="abdomen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Distended">Distended</option>
                                                <option value="Tenderness">Tenderness</option>
                                                <option value="Dysmenorrhea">Dysmenorrhea</option>
                                                <option value="others">Others, specify</option>
                                            </select>
                                            <input type="hidden" id="othersInput4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deformities</label>
                                            <select id="deformities" name="deformities" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="others">Congenital (Specify)</option>
                                            </select>
                                            <input type="hidden"   id="othersInput5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Iron Supplementaion</label>
                                            <select id="iron_supplementation" name="iron_supplementation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deworming</label>
                                            <select id="deworming" name="deworming" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Immunization</label>
                                            <select id="immunization" name="immunization" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SBFP Beneficiary</label>
                                            <select id="sbfp_beneficiary" name="sbfp_beneficiary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">4P's Beneficiary</label>
                                            <select id="four_p_beneficiary" name="four_p_beneficiary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menarche</label>
                                            <select id="menarche" name="menarche" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                            <select id="remarks" name="remarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Healthy">Healthy</option>
                                                <option value="Unhealthy">Unhealthy</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="pt-4 flex justify-center">
                                        <button type="submit" class="text-sm bg-blue-500 rounded-sm py-1 px-2 text-white">submit</button>
                                    </div>
                                </div>
                            </x-forms.form>
                            
                        </div>
                        
                        
                    </div>

                </div>
            </div>
        </div>
        @include('components.modal.student_modal')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.getElementById('mouth').addEventListener('change', function () {
            var othersInput = document.getElementById('othersInput');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function () {
                    document.getElementById('mouth').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function () {
                    document.getElementById('mouth').value = othersInput.value;
                });
            }
        });

        document.getElementById('lungs').addEventListener('change', function () {
            var othersInput = document.getElementById('othersInput2');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function () {
                    document.getElementById('lungs').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function () {
                    document.getElementById('lungs').value = othersInput.value;
                });
            }
        });

        document.getElementById('heart').addEventListener('change', function () {
            var othersInput = document.getElementById('othersInput3');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function () {
                    document.getElementById('heart').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function () {
                    document.getElementById('heart').value = othersInput.value;
                });
            }
        });

        document.getElementById('abdomen').addEventListener('change', function () {
            var othersInput = document.getElementById('othersInput4');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function () {
                    document.getElementById('abdomen').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function () {
                    document.getElementById('abdomen').value = othersInput.value;
                });
            }
        });

        document.getElementById('deformities').addEventListener('change', function () {
            var othersInput = document.getElementById('othersInput5');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function () {
                    document.getElementById('deformities').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function () {
                    document.getElementById('deformities').value = othersInput.value;
                });
            }
        });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
