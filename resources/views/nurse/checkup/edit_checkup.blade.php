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
                                <a href="{{route('view_student',$checkup->student_id)}}" class="text-blue-600 hover:text-blue-800 hover:underline">Student
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
                            <h1 class="font-semibold text-md mb-4">Edit Checkup</h1>
                            <x-forms.form action="{{route('update_checkup',$checkup->id)}}" method="POST">
                                @method('PATCH')
                                <div class="w-[70%] mx-auto space-y-2">
                                    {{-- <div class="grid grid-cols-3 gap-3 ">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
                                            <input type="hidden" name="student_id" value="{{$checkup->student_id}}">
                                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{$checkup->date_of_birth}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birth Place</label>
                                            <input type="text" id="birth_place" name="birth_place" value="{{$checkup->birth_place}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Birth Place" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent/Guardian Name</label>
                                            <input type="text" id="parent_name" name="parent_name" value="{{$checkup->parent_name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mrs. Jane Doe" required />
                                        </div>
                                    </div> --}}
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                            <input type="text" id="student_age" name="student_age" value="{{$checkup->student_age}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="12 years old" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adviser Name</label>
                                            <input type="text" id="adviser_name" name="adviser_name" value="{{$checkup->adviser_name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Adviser Name" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Temperature</label>
                                            <input type="text" id="temperature" value="{{$checkup->temperature}}" name="temperature" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="35.00" required />
                                        </div>
                                    </div> 
                                    {{-- <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region</label>
                                            <input type="text" id="region" name="region" value="{{$checkup->region}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Region" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Division</label>
                                            <input type="text" id="division" name="division" value="{{$checkup->division}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Division" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone/Cellphone</label>
                                            <input type="text" id="telephone_no" value="{{$checkup->telephone_no}}" name="telephone_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+639 3213 3213" required />
                                        </div>
                                    </div> --}}
                                    <div class="grid grid-cols-3 gap-3">
                                        
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Systolic</label>
                                            <input type="text" id="systolic" name="systolic" value="{{$checkup->systolic}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="120" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diastolic</label>
                                            <input type="text" id="diastolic" name="diastolic" value="{{$checkup->diastolic}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="80" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart Rate</label>
                                            <input type="text" id="heart_rate" name="heart_rate" value="{{$checkup->heart_rate}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="72" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pulse Rate</label>
                                            <input type="text" id="pulse_rate" name="pulse_rate" value="{{$checkup->pulse_rate}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="60" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Respiratory Rate</label>
                                            <input type="text" id="respiratory_rate" name="respiratory_rate" value="{{$checkup->respiratory_rate}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="20" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Height(cm)</label>
                                            <input type="text" id="height" name="height" value="{{$checkup->height}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="160.50 cm" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Weight(kg)</label>
                                            <input type="text" id="weight" name="weight" value="{{$checkup->weight}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="55.75 kg" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Nutritional Status (BMI/Wt-for-Age)</label>
                                            <select id="bmi_weight" name="bmi_weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal Weight" {{$checkup->bmi_weight ===  'Normal Weight' ? 'selected':'' }}>Normal Weight</option>
                                                <option value="Wasted Underweight" {{$checkup->bmi_weight ===  'Wasted Underweight' ? 'selected':'' }}>Wasted Underweight</option>
                                                <option value="Severely Wasted Underweight" {{$checkup->bmi_weight ===  'Severely Wasted Underweight' ? 'selected':'' }}>Severely Waster Underweight</option>
                                                <option value="Overweight" {{$checkup->bmi_weight ===  'Overweight' ? 'selected':'' }}>Overweight</option>
                                                <option value="Obese" {{$checkup->bmi_weight ===  'Obese' ? 'selected':'' }}>Obese</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-xs font-medium text-gray-900 dark:text-white">Nutritional Status (Height-for-Age)</label>
                                            <select id="bmi_height" name="bmi_height" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal Height" {{$checkup->bmi_height ===  'Normal Height' ? 'selected':'' }}>Normal Height</option>
                                                <option value="Stunted" {{$checkup->bmi_height ===  'Stunted' ? 'selected':'' }}>Stunted</option>
                                                <option value="Severely Stunted" {{$checkup->bmi_height ===  'Severely Stunted' ? 'selected':'' }}>Severely Stunted</option>
                                                <option value="Tall" {{$checkup->bmi_height ===  'Tall' ? 'selected':'' }}>Tall</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision Screening</label>
                                            <select id="vision_screening" name="vision_screening" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Passed" {{$checkup->vision_screening ===  'Passed' ? 'selected':'' }}>Passed</option>
                                                <option value="Failed" {{$checkup->vision_screening ===  'Failed' ? 'selected':'' }}>Failed</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Audiitory Screening</label>
                                            <select id="auditory_screening" name="auditory_screening" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Passed" {{$checkup->auditory_screening ===  'Passed' ? 'selected':'' }}>Passed</option>
                                                <option value="Failed" {{$checkup->auditory_screening ===  'Failed' ? 'selected':'' }}>Failed</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skin</label>
                                            <select id="skin" name="skin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->skin ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Redness of Skin"  {{$checkup->skin ===  'Redness of Skin' ? 'selected':'' }}>Redness of Skin</option>
                                                <option value="White Spots"  {{$checkup->skin ===  'White Spots' ? 'selected':'' }}>White Spots</option>
                                                <option value="Impetigo/Boil"  {{$checkup->skin ===  'Impetigo/Boil' ? 'selected':'' }}>Impetigo/Boil</option>
                                                <option value="Bruises/Injuries"  {{$checkup->skin ===  'Bruises/Injuries' ? 'selected':'' }}>Bruises/Injuries</option>
                                                <option value="Skin Lessions"  {{$checkup->skin ===  'Skin Lessions' ? 'selected':'' }}>Skin Lessions</option>
                                                <option value="Itchiness"  {{$checkup->skin ===  'Itchiness' ? 'selected':'' }}>Itchiness</option>
                                                <option value="Acne/Pimple"  {{$checkup->skin ===  'Acne/Pimple' ? 'selected':'' }}>Acne/Pimple</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scalp</label>
                                            <select id="scalp" name="scalp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->scalp ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Presence of Lice" {{$checkup->scalp ===  'Presence of Lice' ? 'selected':'' }}>Presence of Lice</option>
                                                <option value="Itchiness" {{$checkup->scalp ===  'Itchiness' ? 'selected':'' }}>Itchiness</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">EYes</label>
                                            <select id="eyes" name="eyes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->eyes ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Stye" {{$checkup->eyes ===  'Stye' ? 'selected':'' }}>Stye</option>
                                                <option value="Eye Redness" {{$checkup->eyes ===  'Eye Redness' ? 'selected':'' }}>Eye Redness</option>
                                                <option value="Ocular Misallignment" {{$checkup->eyes ===  'Ocular Misallignment' ? 'selected':'' }}>Ocular Misallignment</option>
                                                <option value="Pale Conjunctiva" {{$checkup->eyes ===  'Pale Conjunctiva' ? 'selected':'' }}>Pale Conjunctiva</option>
                                                <option value="Eye Discharge" {{$checkup->eyes ===  'Eye Discharge' ? 'selected':'' }}>Eye Discharge</option>
                                                <option value="Matted Eyelashes" {{$checkup->eyes ===  'Matted Eyelashes' ? 'selected':'' }}>Matted Eyelashes</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ear</label>
                                            <select id="ears" name="ears" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->ears ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Ear Discharge" {{$checkup->ears ===  'Ear Discharge' ? 'selected':'' }}>Ear Discharge</option>
                                                <option value="Impacted Cerumen" {{$checkup->ears ===  'Impacted Cerumen' ? 'selected':'' }}>Impacted Cerumen</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nose</label>
                                            <select id="nose" name="nose" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->nose ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Mucus Discharge" {{$checkup->nose ===  'Mucus Discharge' ? 'selected':'' }}>Mucus Discharge</option>
                                                <option value="Nose Bleeding(Eplstaxis)" {{$checkup->nose ===  'Nose Bleeding(Eplstaxis)' ? 'selected':'' }}>Nose Bleeding(Eplstaxis)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mouth/Neck/Throat</label>
                                            <select id="mouth" name="mouth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->mouth ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Enlarge Tonsils" {{$checkup->mouth ===  'Enlarge Tonsils' ? 'selected':'' }}>Enlarge Tonsils</option>
                                                <option value="Presence of Lesions" {{$checkup->mouth ===  'Presence of Lesions' ? 'selected':'' }}>Presence of Lesions</option>
                                                <option value="Inflamed Pharynx" {{$checkup->mouth ===  'Inflamed Pharynx' ? 'selected':'' }}>Inflamed Pharynx</option>
                                                <option value="Enlarge LymphNodes" {{$checkup->mouth ===  'Enlarge LymphNodes' ? 'selected':'' }}>Enlarge LymphNodes</option>
                                                <option value="others" {{$checkup->mouth ===  'others' ? 'selected':'' }}>Others, specify</option>
                                            </select>
                                            <input type="hidden" id="othersInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lungs</label>
                                            <select id="lungs" name="lungs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->lungs ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Rales" {{$checkup->lungs ===  'Rales' ? 'selected':'' }}>Rales</option>
                                                <option value="Wheeze" {{$checkup->lungs ===  'Wheeze' ? 'selected':'' }}>Wheeze</option>
                                                <option value="others" {{$checkup->lungs ===  'others' ? 'selected':'' }}>Others</option>
                                            </select>
                                            <input type="hidden"   id="othersInput2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart</label>
                                            <select id="heart" name="heart" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->heart ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Murmur" {{$checkup->heart ===  'Murmur' ? 'selected':'' }}>Murmur</option>
                                                <option value="Irregular Heart Rate" {{$checkup->heart ===  'Irregular Heart Rate' ? 'selected':'' }}>Irregular Heart Rate</option>
                                                <option value="others" {{$checkup->heart ===  'others' ? 'selected':'' }}>Others</option>
                                            </select>
                                            <input type="hidden"   id="othersInput3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abdomen</label>
                                            <select id="abdomen" name="abdomen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->abdomen ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Distended" {{$checkup->abdomen ===  'Distended' ? 'selected':'' }}>Distended</option>
                                                <option value="Tenderness" {{$checkup->abdomen ===  'Tenderness' ? 'selected':'' }}>Tenderness</option>
                                                <option value="DysmeNorrhea" {{$checkup->abdomen ===  'DysmeNorrhea' ? 'selected':'' }}>DysmeNorrhea</option>
                                                <option value="others" {{$checkup->abdomen ===  'others' ? 'selected':'' }}>Others, specify</option>
                                            </select>
                                            <input type="hidden" id="othersInput4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deformities</label>
                                            <select id="deformities" name="deformities" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->deformities ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Congenital (Specify)" {{$checkup->deformities ===  'Congenital (Specify)' ? 'selected':'' }}>Congenital (Specify)</option>
                                            </select>
                                            <input type="hidden"   id="othersInput5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Iron Supplementaion</label>
                                            <select id="iron_supplementation" name="iron_supplementation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes" {{$checkup->iron_supplementation ===  'Yes' ? 'selected':'' }}>Yes</option>
                                                <option value="No" {{$checkup->iron_supplementation ===  'No' ? 'selected':'' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abdomen</label>
                                            <select id="abdomen" name="abdomen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->abdomen ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Distended" {{$checkup->abdomen ===  'Distended' ? 'selected':'' }}>>Distended</option>
                                                <option value="Tenderness" {{$checkup->abdomen ===  'Tenderness' ? 'selected':'' }}>>Tenderness</option>
                                                <option value="DysmeNorrhea" {{$checkup->abdomen ===  'DysmeNorrhea' ? 'selected':'' }}>>DysmeNorrhea</option>
                                                <option value="others" {{$checkup->abdomen ===  'Normal' ? 'selected':'' }}>>Others, specify</option>
                                            </select>
                                            <input type="hidden" id="othersInput4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deformities</label>
                                            <select id="deformities" name="deformities" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->deformities ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="others" {{$checkup->deformities ===  'others' ? 'selected':'' }}>Congenital (Specify)</option>
                                            </select>
                                            <input type="hidden"   id="othersInput5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please Specify" required />
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Iron Supplementaion</label>
                                            <select id="iron_supplementation" name="iron_supplementation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes" {{$checkup->iron_supplementation ===  'Yes' ? 'selected':'' }}>Yes</option>
                                                <option value="No" {{$checkup->iron_supplementation ===  'No' ? 'selected':'' }}>No</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deworming</label>
                                            <select id="deworming" name="deworming" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes" {{$checkup->deworming ===  'Yes' ? 'selected':'' }}>Yes</option>
                                                <option value="No" {{$checkup->deworming ===  'No' ? 'selected':'' }}>No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Immunization</label>
                                            <select id="immunization" name="immunization" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes" {{$checkup->immunization ===  'Yes' ? 'selected':'' }}>Yes</option>
                                                <option value="No" {{$checkup->immunization ===  'No' ? 'selected':'' }}>No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SBFP Beneficiary</label>
                                            <select id="sbfp_beneficiary" name="sbfp_beneficiary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes" {{$checkup->sbfp_beneficiary ===  'Yes' ? 'selected':'' }}>Yes</option>
                                                <option value="No" {{$checkup->sbfp_beneficiary ===  'No' ? 'selected':'' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">4P's Beneficiary</label>
                                            <select id="four_p_beneficiary" name="four_p_beneficiary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes" {{$checkup->four_p_beneficiary ===  'Yes' ? 'selected':'' }}>Yes</option>
                                                <option value="No" {{$checkup->four_p_beneficiary ===  'No' ? 'selected':'' }}>No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menarche</label>
                                            <select id="menarche" name="menarche" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Yes" {{$checkup->menarche ===  'Yes' ? 'selected':'' }}>Yes</option>
                                                <option value="No" {{$checkup->menarche ===  'No' ? 'selected':'' }}>No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                            <select id="remarks" name="remarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="">Select Value</option>
                                                <option value="Normal" {{$checkup->remarks ===  'Normal' ? 'selected':'' }}>Normal</option>
                                                <option value="Healthy" {{$checkup->remarks ===  'Healthy' ? 'selected':'' }}>Healthy</option>
                                                <option value="Unhealthy" {{$checkup->remarks ===  'Unhealthy' ? 'selected':'' }}>Unhealthy</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="pt-4 flex justify-center">
                                        <button type="submit" class="text-sm bg-blue-500 rounded-sm py-1 px-2 text-white">update</button>
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
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</x-layout>
