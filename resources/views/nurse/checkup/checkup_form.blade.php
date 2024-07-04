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
                            <form action="{{route('store_checkup',$student->id)}}" method="post">
                                @csrf
                                <div class="w-[70%] mx-auto space-y-2">
                                    <div class="grid grid-cols-3 gap-3 ">
                                        <div class="relative max-w-sm">
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>

                                            <div class="absolute bottom-3 start-0 flex items-center ps-3.5 pointer-events-none">
                                                <svg class="w-4 h-4 text-blue-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                                </svg>
                                            </div>
                                            <input datepicker id="default-datepicker" name="data_of_birth" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Place</label>
                                            <input type="text" id="birth_place" name="birth_place" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Birth Place" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent/Guardian Name</label>
                                            <input type="text" id="parent_name" name="parent_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mrs. Jane Doe" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adviser Name</label>
                                            <input type="text" id="adviser_name" name="adviser_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Adviser Name" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School Id</label>
                                            <input type="text" id="school_id" name="school_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="School ID" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region</label>
                                            <input type="text" id="region" name="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Region" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                                            <input type="text" id="divison" name="divison" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Division" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone Number</label>
                                            <input type="text" id="telephone_no" name="telephone_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+639 3213 3213" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Temperature</label>
                                            <input type="number" id="temperature" name="temperature" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="35.00" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Systolic</label>
                                            <input type="number" id="systolic" name="systolic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="120" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart Rate</label>
                                            <input type="number" id="heart_rate" name="heart_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="72" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pulse Rate</label>
                                            <input type="number" id="pulse_rate" name="pulse_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="60" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Respiratory Rate</label>
                                            <input type="number" id="respiratory_rate" name="respiratory_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="20" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Height(cm)</label>
                                            <input type="number" id="height" name="height" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="160.50 cm" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight(kg)</label>
                                            <input type="number" id="weight" name="weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="55.75 kg" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Nutritional Status (BMI/Wt-for-Age)</label>
                                            <select id="bmi_weight" name="bmi_weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal_weight">Normal Weight</option>
                                                <option value="wasted_underweight">Wasted Underweight</option>
                                                <option value="severly_wasted_underweight">Serverly Waster Underweight</option>
                                                <option value="overweight">Overweight</option>
                                                <option value="obese">Obese</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Nutritional Status (Height-for-Age)</label>
                                            <select id="bmi_height" name="bmi_height" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal_height">Normal Height</option>
                                                <option value="stunted">Stunted</option>
                                                <option value="severly_stunted">Serverly Stunted</option>
                                                <option value="tall">Tall</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision Screening</label>
                                            <select id="vision_screening" name="vision_screening" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="passed">Passed</option>
                                                <option value="failed">Failed</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skin</label>
                                            <select id="skin" name="skin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="redness_of_skin">Redness of Skin</option>
                                                <option value="white_spots">White Spots</option>
                                                <option value="impetigo_boil">Impetigo/Boil</option>
                                                <option value="bruises_injuries">Bruises/Injuries</option>
                                                <option value="skin_lessions">Skin Lessions</option>
                                                <option value="itchiness">Itchiness</option>
                                                <option value="acne_pimple">Acne/Pimple</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scalp</label>
                                            <select id="scalp" name="scalp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="presence_of_lice">Presence of Lice</option>
                                                <option value="itchiness">Itchiness</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Eyes</label>
                                            <select id="eyes" name="eyes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="stye">Stye</option>
                                                <option value="eye_redness">Eye Redness</option>
                                                <option value="ocular_misallignment">Ocular Misallignment</option>
                                                <option value="pale_conjuctiva">Pale Conjunctiva</option>
                                                <option value="eye_discharge">Eye Discharge</option>
                                                <option value="matted_eyelashes">Matted Eyelashes</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ear</label>
                                            <select id="ear" name="ear" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="ear_discharge">Ear Discharge</option>
                                                <option value="impacted_cerumen">Impacted Cerumen</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nose</label>
                                            <select id="nose" name="nose" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="mucus_discharge">Mucus Discharge</option>
                                                <option value="nose_bleeding">Nose Bleeding(Eplstaxis)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mouth/Neck/Throat</label>
                                            <select id="mouth" name="mouth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="enlarge_tonsils">Enlarge Tonsils</option>
                                                <option value="presence_of_lesions">Presence of Lesions</option>
                                                <option value="inflamed_pharynx">Inflamed Pharynx</option>
                                                <option value="enlarge_lyphnodes">Enlarge Lymphnodes</option>
                                                <option value="others">Others, specify</option>
                                            </select>
                                            <input type="hidden" id="othersInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lungs</label>
                                            <select id="lungs" name="lungs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="rales">Rales</option>
                                                <option value="wheeze">Wheeze</option>
                                                <option value="others">Others</option>
                                            </select>
                                            <input type="hidden"   id="othersInput2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart</label>
                                            <select id="heart" name="heart" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="murmur">Murmur</option>
                                                <option value="irregular">Irregular Heart Rate</option>
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
                                                <option value="normal">Normal</option>
                                                <option value="distended">Distended</option>
                                                <option value="tenderness">Tenderness</option>
                                                <option value="dysmenorrhea">Dysmenorrhea</option>
                                                <option value="others">Others, specify</option>
                                            </select>
                                            <input type="hidden" id="othersInput4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deformities</label>
                                            <select id="deformities" name="deformities" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="others">Congenital (Specify)</option>
                                            </select>
                                            <input type="hidden"   id="othersInput5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Iron Supplementaion</label>
                                            <select id="iron_supplementation" name="iron_supplementation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abdomen</label>
                                            <select id="abdomen" name="abdomen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="distended">Distended</option>
                                                <option value="tenderness">Tenderness</option>
                                                <option value="dysmenorrhea">Dysmenorrhea</option>
                                                <option value="others">Others, specify</option>
                                            </select>
                                            <input type="hidden" id="othersInput4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deformities</label>
                                            <select id="deformities" name="deformities" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="normal">Normal</option>
                                                <option value="others">Congenital (Specify)</option>
                                            </select>
                                            <input type="hidden"   id="othersInput5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Iron Supplementaion</label>
                                            <select id="iron_supplementation" name="iron_supplementation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deworming</label>
                                            <select id="deworming" name="deworming" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Immunization</label>
                                            <select id="immunization" name="immunization" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SBFP Beneficiary</label>
                                            <select id="sbfp_beneficiary" name="sbfp_beneficiary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">4P's Beneficiary</label>
                                            <select id="4ps_beneficiary" name="4ps_beneficiary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menarche</label>
                                            <select id="menarche" name="menarche" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Others</label>
                                            <input type="text" id="others_check" name="others_check" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Others" />
                                        </div>
                                    </div>
                                    <div class="pt-4 flex justify-center">
                                        <button class="text-sm bg-blue-500 rounded-sm py-1 px-2 text-white">submit</button>
                                    </div>
                                </div>
                            </form>
                            
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

        document.getElementById('heart').addEventListener('change', function () {
            var othersInput = document.getElementById('othersInput3');
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

        document.getElementById('abdomen').addEventListener('change', function () {
            var othersInput = document.getElementById('othersInput4');
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

        document.getElementById('deformities').addEventListener('change', function () {
            var othersInput = document.getElementById('othersInput5');
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
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
