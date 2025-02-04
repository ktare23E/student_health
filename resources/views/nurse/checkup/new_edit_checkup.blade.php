<x-layout>
    <div class="p-8 bg-blue-100">
        <a href="{{route('view_student',$student->id)}}" class="bg-white py-1 px-2 rounded sm ">Back</a>
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="text-xl font-bold uppercase">Department of Education</h1>
            <h2 class="text-lg font-semibold">Bureau of Learner Support Services - School Health Division</h2>
            <h3 class="text-md">Pasig City</h3>
            <h4 class="text-lg font-semibold mt-4">School Health Examination Card</h4>
        </div>

        <!-- Student Info Section -->
        <div class="border p-4 bg-white rounded shadow">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Name:</label>
                    <div class="flex gap-2">
                        <input type="text" placeholder="First" class="border p-2 rounded w-1/2"
                            value="{{ $student->first_name }}" readonly>
                        <input type="text" placeholder="Last" class="border p-2 rounded w-1/2"
                            value="{{ $student->last_name }}" readonly>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">School:</label>
                    <input type="text" placeholder="Enter School ID" class="border p-2 rounded w-full"
                        value="{{ $student->school->name }}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Date of Birth:</label>
                    <div class="flex gap-2">
                        <input type="text" placeholder="Month" class="border p-2 rounded w-full"
                            value="{{ \Carbon\Carbon::parse($student->date_of_birth)->format('F d, Y') }}" readonly>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">Region:</label>
                    <input type="text" placeholder="Enter Region" class="border p-2 rounded w-full"
                        value="{{ $student->region }}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Birthplace:</label>
                    <input type="text" placeholder="Enter Birthplace" class="border p-2 rounded w-full"
                        value="{{ $student->birth_place }}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Division:</label>
                    <input type="text" placeholder="Enter Division" class="border p-2 rounded w-full"
                        value="{{ $student->school->district->division->name }}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Parent/Guardian:</label>
                    <input type="text" placeholder="Enter Parent/Guardian Name" class="border p-2 rounded w-full"
                        value="{{ $student->parent_name }}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Telephone No.:</label>
                    <input type="text" placeholder="Enter Telephone No." class="border p-2 rounded w-full"
                        value="{{ $student->cellphone_number }}" readonly>
                </div>
                <div class="col-span-2">
                    <div>
                        <label class="block font-semibold">Address:</label>
                        <input type="text" placeholder="Enter Address" class="border p-2 rounded w-full"
                            value="{{ $student->address }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <!-- Examination Table -->
        <div class="border p-4 bg-white rounded shadow mt-6">
            <x-forms.form action="{{route('update_checkup',$checkup->id)}}" method="POST">
                @method('PATCH')
                @csrf
                <table class="table-auto border-collapse w-full text-sm">
                    <thead>
                        <tr>
                            <th class="border p-2"></th>
                            @for ($i = 1; $i <= 12; $i++)
                                <th class="border p-2">Grade {{$i}}/SPED</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Placeholder rows for the table -->
                        <tr>
                            <td class="border p-2 text-center">Date of Examination</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="date_of_checkup"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Date of Examination</label>
                                                    <input type="text" id="date_of_chekup" name="date_of_checkup" value="{{\Carbon\Carbon::parse($checkup->date_of_checkup)->format('F j, Y')}}" readonly
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required />
                                                </div> 
                                            @else
                                                <span>{{ \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F j, Y') }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Age</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Loop through checkups for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level )
                                                <div>
                                                    <label for="student_age_{{ $i }}"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Age
                                                    </label>
                                                    <input type="text" id="student_age_{{ $i }}" name="student_age" 
                                                        value="{{ $checkup->student_age }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="15" required />
                                                </div>
                                            @else
                                                <span>{{ $checkup->student_age }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        
                        <tr>
                            <td class="border p-2 text-center">Adviser</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="heart_rate_{{ $i }}"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Adviser
                                                    </label>
                                                    <input type="text" id="adviser_name_{{ $i }}" name="adviser_name" value="{{$checkup->adviser_name}}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Test Name" required />
                                                </div>
                                            @else
                                                {{ $checkup->adviser_name }}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Temperature</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="temperature{{ $i }}"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Temperature
                                                    </label>
                                                    <input type="text" id="temperature_{{ $i }}" name="temperature" value="{{Crypt::decrypt($checkup->temperature)}}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="35.00" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->temperature) }}</span>
                                            @endif
                                            
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">BP</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div class="flex gap-2">
                                                    <div class="mb-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-start text-gray-900 dark:text-white">Systolic</label>
                                                        <input type="text" id="systolic" name="systolic" value="{{Crypt::decrypt($checkup->systolic)}}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="120" required />
                                                    </div>
                                                    <div>
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium  text-start text-gray-900 dark:text-white">Diastolic</label>
                                                        <input type="text" id="diastolic" name="diastolic" value="{{Crypt::decrypt($checkup->diastolic)}}"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="80" required />
                                                    </div>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->systolic.'/'.$checkup->diastolic) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Heart Rate</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="heart_rate_{{ $i }}"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Heart Rate
                                                    </label>
                                                    <input type="text" id="heart_rate" name="heart_rate" value="{{Crypt::decrypt($checkup->heart_rate)}}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="72" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->heart_rate) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Pulse Rate</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="heart_rate_{{ $i }}"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Pulse Rate
                                                    </label>
                                                    <input type="text" id="pulse_rate_{{ $i }}" name="pulse_rate" value="{{Crypt::decrypt($checkup->pulse_rate)}}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="60" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->pulse_rate) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Respiratory Rate</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="heart_rate_{{ $i }}"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Respiratory Rate
                                                    </label>
                                                    <input type="text" id="respiratory_rate_{{ $i }}" name="respiratory_rate" value="{{Crypt::decrypt($checkup->respiratory_rate)}}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="20" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->respiratory_rate) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Height</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="heart_rate_{{ $i }}"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Height
                                                    </label>
                                                    <input type="text" id="height" name="height" value="{{Crypt::decrypt($checkup->height)}}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="1.60 meters" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->height).' meters' }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Weight</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="heart_rate_{{ $i }}"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Weight
                                                    </label>
                                                    <input type="text" id="weight" name="weight" value="{{Crypt::decrypt($checkup->weight)}}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="72" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->weight).'kg' }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Nutritional Status (BMI)</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div class="mb-2">
                                                    <label for="bmi"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">BMI</label>
                                                    <input type="text" id="bmi" name="bmi"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        readonly />
                                                </div>
                                                <div>
                                                    <label for="bmi_weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Nutritional Status (BMI)</label>
                                                    <select id="bmi_weight" name="bmi_weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                        <option value="Underweight" {{Crypt::decrypt($checkup->bmi_weight) === 'Underweight' ? 'selected' : ''}}>Underweight</option>
                                                        <option value="Normal Weight" {{Crypt::decrypt($checkup->bmi_weight) === 'Normal Weight' ? 'selected' : ''}}>Normal Weight</option>
                                                        <option value="Overweight" {{Crypt::decrypt($checkup->bmi_weight) === 'Overweight' ? 'selected' : ''}}>Overweight</option>
                                                        <option value="Obese" {{Crypt::decrypt($checkup->bmi_weight) === 'Obese' ? 'selected' : ''}}>Obese</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->bmi_weight) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Nutritional Status (Height)</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="bmi"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nutritional Status (Height)</label>
                                                    <select id="bmi_height" name="bmi_height"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="Normal Height" {{Crypt::decrypt($checkup->bmi_height)  === 'Underweight' ? 'selected' : ''}}>Normal Height</option>
                                                        <option value="Stunted" {{Crypt::decrypt($checkup->bmi_height)  === 'Stunted' ? 'selected' : ''}}>Stunted</option>
                                                        <option value="Severely Stunted" {{Crypt::decrypt($checkup->bmi_height)  === 'Severely Stunted' ? 'selected' : ''}}>Severely Stunted</option>
                                                        <option value="Tall" {{Crypt::decrypt($checkup->bmi_height)  === 'Tall' ? 'selected' : ''}}>Tall</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->bmi_height) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Vision Screening</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision
                                                        Screening</label>
                                                    <select id="vision_screening" name="vision_screening"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Passed" {{Crypt::decrypt($checkup->vision_screening) === 'Passed' ? 'selected' : ''}}>Passed</option>
                                                        <option value="Failed" {{Crypt::decrypt($checkup->vision_screening) === 'Failed' ? 'selected' : ''}}>Failed</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->vision_screening) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Auditory Screening</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Auditory
                                                        Screening</label>
                                                    <select id="auditory_screening" name="auditory_screening"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Passed" {{Crypt::decrypt($checkup->auditory_screening) === 'Passed' ? 'selected' : ''}}>Passed</option>
                                                        <option value="Failed" {{Crypt::decrypt($checkup->auditory_screening) === 'Failed' ? 'selected' : ''}}>Failed</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->auditory_screening) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Skin</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skin</label>
                                                    <select id="skin" name="skin"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->skin) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Redness of Skin" {{Crypt::decrypt($checkup->skin) === 'Redness of Skin' ? 'selected' : ''}}>Redness of Skin</option>
                                                        <option value="White Spots" {{Crypt::decrypt($checkup->skin) === 'White Spots' ? 'selected' : ''}}>White Spots</option>
                                                        <option value="Impetigo/Boil" {{Crypt::decrypt($checkup->skin) === 'Impetigo/Boil' ? 'selected' : ''}}>Impetigo/Boil</option>
                                                        <option value="Bruises/Injuries" {{Crypt::decrypt($checkup->skin) === 'Bruises/Injuries' ? 'selected' : ''}}>Bruises/Injuries</option>
                                                        <option value="Skin Lessions" {{Crypt::decrypt($checkup->skin) === 'Skin Lessions' ? 'selected' : ''}}>Skin Lessions</option>
                                                        <option value="Itchiness" {{Crypt::decrypt($checkup->skin) === 'Itchiness' ? 'selected' : ''}}>Itchiness</option>
                                                        <option value="Acne/Pimple" {{Crypt::decrypt($checkup->skin) === 'Acne/Pimple' ? 'selected' : ''}}>Acne/Pimple</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->skin) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Scalp</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skin</label>
                                                    <select id="skin" name="scalp"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->scalp) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Presence of Lice" {{Crypt::decrypt($checkup->scalp) === 'Presence of Lice' ? 'selected' : ''}}>Presence of Lice</option>
                                                        <option value="Itchiness" {{Crypt::decrypt($checkup->scalp) === 'Itchiness' ? 'selected' : ''}}>Itchiness</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->scalp) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Eyes</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Eyes</label>
                                                    <select id="skin" name="eyes"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->eyes) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Stye" {{Crypt::decrypt($checkup->eyes) === 'Stye' ? 'selected' : ''}}>Stye</option>
                                                        <option value="Eye Redness" {{Crypt::decrypt($checkup->eyes) === 'Eye Redness' ? 'selected' : ''}}>Eye Redness</option>
                                                        <option value="Ocular Misallignment" {{Crypt::decrypt($checkup->eyes) === 'Ocular Misallignment' ? 'selected' : ''}}>Ocular Misallignment</option>
                                                        <option value="Pale Conjunctiva" {{Crypt::decrypt($checkup->eyes) === 'Pale Conjunctiva"' ? 'selected' : ''}}>Pale Conjunctiva</option>
                                                        <option value="Eye Discharge" {{Crypt::decrypt($checkup->eyes) === 'Eye Discharge' ? 'selected' : ''}}>Eye Discharge</option>
                                                        <option value="Matted Eyelashes" {{Crypt::decrypt($checkup->eyes) === 'Matted Eyelashes' ? 'selected' : ''}}>Matted Eyelashes</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->eyes) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Ears</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ears</label>
                                                    <select id="ears" name="ears"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->ears) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Ear Discharge" {{Crypt::decrypt($checkup->ears) === 'Ear Discharge' ? 'selected' : ''}}>Ear Discharge</option>
                                                        <option value="Impacted Cerumen" {{Crypt::decrypt($checkup->ears) === 'Impacted Cerumen' ? 'selected' : ''}}>Impacted Cerumen</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->ears) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Nose</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nose</label>
                                                    <select id="nose" name="nose"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->nose) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Mucus Discharge" {{Crypt::decrypt($checkup->nose) === 'Mucus Discharge' ? 'selected' : ''}}>Mucus Discharge</option>
                                                        <option value="Nose Bleeding(Eplstaxis)" {{Crypt::decrypt($checkup->nose) === 'Nose Bleeding(Eplstaxis)' ? 'selected' : ''}}>Nose Bleeding(Eplstaxis)
                                                        </option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->nose) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Mouth</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mouth/Neck/Throat</label>
                                                    <select id="mouth" name="mouth"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->mouth) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Enlarge Tonsils" {{Crypt::decrypt($checkup->mouth) === 'Enlarge Tonsils' ? 'selected' : ''}}>Enlarge Tonsils</option>
                                                        <option value="Presence of Lesions" {{Crypt::decrypt($checkup->mouth) === 'Presence of Lesions' ? 'selected' : ''}}>Presence of Lesions</option>
                                                        <option value="Inflamed Pharynx" {{Crypt::decrypt($checkup->mouth) === 'Inflamed Pharynx' ? 'selected' : ''}}>Inflamed Pharynx</option>
                                                        <option value="Enlarge LymphNodes" {{Crypt::decrypt($checkup->mouth) === 'Enlarge LymphNodes' ? 'selected' : ''}}>Enlarge LymphNodes</option>
                                                        <option value="others">Others, specify</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @else   
                                                <span>{{ Crypt::decrypt($checkup->mouth) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Lungs</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lungs</label>
                                                    <select id="lungs" name="lungs"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->lungs) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Rales" {{Crypt::decrypt($checkup->lungs) === 'Rales' ? 'selected' : ''}}>Rales</option>
                                                        <option value="Wheeze" {{Crypt::decrypt($checkup->lungs) === 'Wheeze' ? 'selected' : ''}}>Wheeze</option>
                                                        <option value="others" {{Crypt::decrypt($checkup->lungs) === 'others' ? 'selected' : ''}}>Others</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput2"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->lungs) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Heart</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart</label>
                                                    <select id="heart" name="heart"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->heart) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Murmur" {{Crypt::decrypt($checkup->heart) === 'Murmur' ? 'selected' : ''}}>Murmur</option>
                                                        <option value="Irregular Heart Rate" {{Crypt::decrypt($checkup->heart) === 'Irregular Heart Rate' ? 'selected' : ''}}>Irregular Heart Rate</option>
                                                        <option value="others" {{Crypt::decrypt($checkup->heart) === 'others' ? 'selected' : ''}}>Others</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput3"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->heart) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Abdomen</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abdomen</label>
                                                    <select id="abdomen" name="abdomen"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->abdomen) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Distended" {{Crypt::decrypt($checkup->abdomen) === 'Distended' ? 'selected' : ''}}>Distended</option>
                                                        <option value="Tenderness" {{Crypt::decrypt($checkup->abdomen) === 'Tenderness' ? 'selected' : ''}}>Tenderness</option>
                                                        <option value="Dysmenorrhea" {{Crypt::decrypt($checkup->abdomen) === 'Dysmenorrhea' ? 'selected' : ''}}>Dysmenorrhea</option>
                                                        <option value="others" {{Crypt::decrypt($checkup->abdomen) === 'others' ? 'selected' : ''}}>Others, specify</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput4"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->abdomen) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Deformities</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deformities</label>
                                                    <select id="deformities" name="deformities"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->deformities) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="others" {{Crypt::decrypt($checkup->deformities) === 'others' ? 'selected' : ''}}>Congenital (Specify)</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput5"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->deformities) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Iron Supplmentation</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Iron
                                                        Supplementaion</label>
                                                    <select id="iron_supplementation" name="iron_supplementation"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes" {{Crypt::decrypt($checkup->iron_supplementation) === 'Yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="No" {{Crypt::decrypt($checkup->iron_supplementation) === 'No' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->iron_supplementation) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Deworming</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deworming</label>
                                                    <select id="deworming" name="deworming"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes" {{Crypt::decrypt($checkup->deworming) === 'Yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="No" {{Crypt::decrypt($checkup->deworming) === 'No' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->deworming) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Immunization</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Immunization</label>
                                                    <select id="immunization" name="immunization"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes" {{Crypt::decrypt($checkup->immunization) === 'Yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="No" {{Crypt::decrypt($checkup->immunization) === 'No' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->immunization) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">SBFP Beneficiary</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">SBFP
                                                        Beneficiary</label>
                                                    <select id="sbfp_beneficiary" name="sbfp_beneficiary"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes" {{Crypt::decrypt($checkup->sbfp_beneficiary) === 'Yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="No" {{Crypt::decrypt($checkup->sbfp_beneficiary) === 'No' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->sbfp_beneficiary) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">4P's Beneficiary</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">4P's
                                                        Beneficiary</label>
                                                    <select id="four_p_beneficiary" name="four_p_beneficiary"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes" {{Crypt::decrypt($checkup->four_p_beneficiary) === 'Yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="No" {{Crypt::decrypt($checkup->four_p_beneficiary) === 'No' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->four_p_beneficiary) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Menarche</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menarche</label>
                                                    <select id="menarche" name="menarche"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes" {{Crypt::decrypt($checkup->menarche) === 'Yes' ? 'selected' : ''}}>Yes</option>
                                                        <option value="No" {{Crypt::decrypt($checkup->menarche) === 'No' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->menarche) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Conducted by</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Conducted by</label>
                                                    <input type="text" name="nurse_name" value="{{$nurse->test_name}}" 
                                                    id="heart_rate" name="heart_rate"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="72" required />
                                                </div>
                                            @else
                                                <span>{{ $checkup->nurse->test_name }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Remarks</td>
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="border p-2 text-center">
                                    @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                        {{-- Display heart rate data for the grade --}}
                                        @foreach ($checkupsByGrade[$i] as $checkup)
                                            @if ($checkup->student_grade_level == $check_up_grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                                    <select id="remarks" name="remarks"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal" {{Crypt::decrypt($checkup->remarks) === 'Normal' ? 'selected' : ''}}>Normal</option>
                                                        <option value="Healthy" {{Crypt::decrypt($checkup->remarks) === 'Healthy' ? 'selected' : ''}}>Healthy</option>
                                                        <option value="Unhealthy" {{Crypt::decrypt($checkup->remarks) === 'Unhealthy' ? 'selected' : ''}}>Unhealthy</option>
                                                    </select>
                                                </div>
                                            @else
                                                <span>{{ Crypt::decrypt($checkup->remarks) }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
                <div>
                    <button type="submit" class="w-full text-center mt-2 py-1 px-2 bg-blue-600 text-white rounded-sm cursor-pointer">update</button>
                </div>
            </x-forms>
            
        </div>

        <!-- Legend -->
        <div class="border p-4 bg-white rounded shadow mt-6">
            <h3 class="font-semibold">Legend:</h3>
            <table class="table-auto border-collapse w-full text-sm">
                <thead>
                    <tr>
                        <th class="border p-2">NS</th>
                        <th class="border p-2">Vision/Auditory Screening</th>
                        <th class="border p-2">Skin/Scalp</th>
                        <th class="border p-2">Eye/Ear/Nose</th>
                        <th class="border p-2">Mouth/Neck/Throat</th>
                        <th class="border p-2">Lungs/Heart</th>
                        <th class="border p-2">Abdomen</th>
                        <th class="border p-2">Deformities</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Placeholder rows for the table -->
                    <tr>
                        <td class="border p-2 text-center">a. Normal Weight</td>
                        <td class="border p-2 text-center">a. Passed</td>
                        <td class="border p-2 text-center">a. Normal</td>
                        <td class="border p-2 text-center">a. Normal</td>
                        <td class="border p-2 text-center">a. Normal</td>
                        <td class="border p-2 text-center">a. Normal</td>
                        <td class="border p-2 text-center">a. Normal</td>
                        <td class="border p-2 text-center">a. Acquired</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">b. Wasted Underweight</td>
                        <td class="border p-2 text-center">b. Failed</td>
                        <td class="border p-2 text-center">b. Presence of Lice</td>
                        <td class="border p-2 text-center">b. Stye</td>
                        <td class="border p-2 text-center">b. Enlarged tonsils</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">b. Distended</td>
                        <td class="border p-2 text-center">b. Congenital (Specify)</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">c. Severely Wasted/Underweight</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">c. Redness of Skin</td>
                        <td class="border p-2 text-center">c.Eye Redness</td>
                        <td class="border p-2 text-center">c. Presence of lesions</td>
                        <td class="border p-2 text-center">c. Rales</td>
                        <td class="border p-2 text-center">c. Abdominal Pain</td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">d. Overweight</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">d. White Spots</td>
                        <td class="border p-2 text-center">d. Ocular Misalignment</td>
                        <td class="border p-2 text-center">d. Inflamed pharynx</td>
                        <td class="border p-2 text-center">d. Wheeze</td>
                        <td class="border p-2 text-center">d. Tenderness</td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">e. Obese</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">e. Flaky Skin</td>
                        <td class="border p-2 text-center">e. Pale Conjunctiva/td>
                        <td class="border p-2 text-center">e. Enlarged Lymphnodes</td>
                        <td class="border p-2 text-center">e. Murmur</td>
                        <td class="border p-2 text-center">e. Dysmenorrhea</td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">f. Normal Height</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">f. Impetigo/boil</td>
                        <td class="border p-2 text-center">f. Ear discharge</td>
                        <td class="border p-2 text-center">f. Others, specify</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">f. Others, Specify</td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">g. Stunted</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">g. Hematoma</td>
                        <td class="border p-2 text-center">g. Impacted cerumen</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">h. Severely Stunted</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">h. Bruises/Injuries</td>
                        <td class="border p-2 text-center">h. Mucus discharge</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">i. Tall</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">i. Itchiness</td>
                        <td class="border p-2 text-center">i. Nose Bleeding</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">j. Skin Lesions</td>
                        <td class="border p-2 text-center">j. Eye discharge</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">k. Acne /Pimple</td>
                        <td class="border p-2 text-center">k. Matted Eyelashes</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.getElementById('mouth').addEventListener('change', function() {
            var othersInput = document.getElementById('othersInput');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function() {
                    document.getElementById('mouth').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function() {
                    document.getElementById('mouth').value = othersInput.value;
                });
            }
        });

        document.getElementById('lungs').addEventListener('change', function() {
            var othersInput = document.getElementById('othersInput2');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function() {
                    document.getElementById('lungs').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function() {
                    document.getElementById('lungs').value = othersInput.value;
                });
            }
        });

        document.getElementById('heart').addEventListener('change', function() {
            var othersInput = document.getElementById('othersInput3');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function() {
                    document.getElementById('heart').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function() {
                    document.getElementById('heart').value = othersInput.value;
                });
            }
        });

        document.getElementById('abdomen').addEventListener('change', function() {
            var othersInput = document.getElementById('othersInput4');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function() {
                    document.getElementById('abdomen').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function() {
                    document.getElementById('abdomen').value = othersInput.value;
                });
            }
        });

        document.getElementById('deformities').addEventListener('change', function() {
            var othersInput = document.getElementById('othersInput5');
            if (this.value === 'others') {
                this.classList.add('hidden');
                othersInput.type = 'text';
                othersInput.removeEventListener('input', function() {
                    document.getElementById('deformities').value = othersInput.value;
                });
            } else {
                othersInput.type = 'hidden';
                this.classList.remove('hidden');
                othersInput.removeEventListener('input', function() {
                    document.getElementById('deformities').value = othersInput.value;
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            function calculateBMI() {
                // Retrieve and parse the input values
                var height = parseFloat($('#height').val());
                var weight = parseFloat($('#weight').val());

                // Validate the inputs
                if (isNaN(height) || isNaN(weight) || height <= 0 || weight <= 0) {
                    $('#bmi').val('Invalid input');
                    $('#bmi_weight').val('');
                    return;
                }

                // Calculate BMI
                var bmi = weight / (height * height);
                var bmiRounded = bmi.toFixed(2);

                // Update the BMI input field
                $('#bmi').val(bmiRounded);

                // Determine nutritional status
                var status = '';
                if (bmi < 18.5) {
                    status = 'Underweight';
                } else if (bmi >= 18.5 && bmi < 24.9) {
                    status = 'Normal Weight';
                } else if (bmi >= 25 && bmi < 29.9) {
                    status = 'Overweight';
                } else if (bmi >= 30) {
                    status = 'Obese';
                }

                // Update the nutritional status dropdown
                $('#bmi_weight').val(status);
            }

            // Attach the calculateBMI function to input events
            $('#height, #weight').on('input', function() {
                calculateBMI();
            });
        });
    </script>
</x-layout>
