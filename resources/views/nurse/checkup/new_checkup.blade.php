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
            <x-forms.form action="{{route('store_checkup',$student->id)}}" method="POST">
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
                            {{-- @dd($checkups) --}}
                            <td class="border p-2 text-center">Date of Examination</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F j, Y') }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Date of Examination</label>
                                                    <input type="text" id="student_age" name="date_of_checkup" value="{{ now()->format('F d, Y') }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required />
                                                </div>  
                                                {{-- <input type="text" class="border-2" name="date" value="{{ now()->format('F d, Y') }}"> --}}
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Age</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->student_age }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Age</label>
                                                    <input type="text" id="student_age" name="student_age"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="12 years old" required />
                                                </div>                                        
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Adviser</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->adviser_name }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Adviser Name</label>
                                                    <input type="text" id="student_age" name="adviser_name"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Ms. Juvy Test" required />
                                                </div>  
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Temperature</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->temperature }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-start text-gray-900 dark:text-white">Temperature</label>
                                                    <input type="text" id="temperature" name="temperature"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="35.00" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">BP</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->systolic.'/'.$checkup->diastolic }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div class="flex gap-2">
                                                    <div class="mb-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-start text-gray-900 dark:text-white">Systolic</label>
                                                        <input type="text" id="systolic" name="systolic"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="120" required />
                                                    </div>
                                                    <div>
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium  text-start text-gray-900 dark:text-white">Diastolic</label>
                                                        <input type="text" id="diastolic" name="diastolic"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="80" required />
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Heart Rate</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->heart_rate }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                            <div>
                                                <label for="name"
                                                    class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart
                                                    Rate</label>
                                                <input type="text" id="heart_rate" name="heart_rate"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="72" required />
                                            </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Pulse Rate</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->pulse_rate }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pulse
                                                        Rate</label>
                                                    <input type="text" id="pulse_rate" name="pulse_rate"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="60" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Respiratory Rate</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->respiratory_rate }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Respiratory
                                                        Rate</label>
                                                    <input type="text" id="respiratory_rate" name="respiratory_rate"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="20" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Height</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->height.' meters' }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Height(m)</label>
                                                    <input type="text" id="height" name="height"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="160.50 meters" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Weight</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->weight.'kg' }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-xs font-medium text-gray-900 dark:text-white">Weight(kg)</label>
                                                    <input type="text" id="weight" name="weight"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="55.75 kg" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Nutritional Status (BMI)</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->bmi_weight }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
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
                                                    <option value="">Select Value</option>
                                                    <option value="Underweight">Underweight</option>
                                                    <option value="Normal Weight">Normal Weight</option>
                                                    <option value="Overweight">Overweight</option>
                                                    <option value="Obese">Obese</option>
                                                </select>
                                            </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Nutritional Status (Height)</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->bmi_height }}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                            <div>
                                                <label for="bmi"
                                                    class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nutritional Status (Height)</label>
                                                <select id="bmi_height" name="bmi_height"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    required>
                                                    <option value="">Select Value</option>
                                                    <option value="Normal Height">Normal Height</option>
                                                    <option value="Stunted">Stunted</option>
                                                    <option value="Severely Stunted">Severely Stunted</option>
                                                    <option value="Tall">Tall</option>
                                                </select>
                                            </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Vision Screening</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->vision_screening}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vision
                                                        Screening</label>
                                                    <select id="vision_screening" name="vision_screening"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Passed">Passed</option>
                                                        <option value="Failed">Failed</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Auditory Screening</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->auditory_screening}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Auditory
                                                        Screening</label>
                                                    <select id="auditory_screening" name="auditory_screening"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Passed">Passed</option>
                                                        <option value="Failed">Failed</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Skin</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->skin}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                            <div>
                                                <label for="name"
                                                    class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skin</label>
                                                <select id="skin" name="skin"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    required>
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
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Scalp</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->scalp}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scalp</label>
                                                    <select id="scalp" name="scalp"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Presence of Lice">Presence of Lice</option>
                                                        <option value="Itchiness">Itchiness</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Eyes</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->eyes}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Eyes</label>
                                                    <select id="eyes" name="eyes"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
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
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Ears</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->ears}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ear</label>
                                                    <select id="ears" name="ears"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Ear Discharge">Ear Discharge</option>
                                                        <option value="Impacted Cerumen">Impacted Cerumen</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Nose</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->nose}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nose</label>
                                                    <select id="nose" name="nose"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Mucus Discharge">Mucus Discharge</option>
                                                        <option value="Nose Bleeding(Eplstaxis)">Nose Bleeding(Eplstaxis)
                                                        </option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Mouth</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->mouth}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mouth/Neck/Throat</label>
                                                    <select id="mouth" name="mouth"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Enlarge Tonsils">Enlarge Tonsils</option>
                                                        <option value="Presence of Lesions">Presence of Lesions</option>
                                                        <option value="Inflamed Pharynx">Inflamed Pharynx</option>
                                                        <option value="Enlarge LymphNodes">Enlarge LymphNodes</option>
                                                        <option value="others">Others, specify</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Lungs</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->lungs}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lungs</label>
                                                    <select id="lungs" name="lungs"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Rales">Rales</option>
                                                        <option value="Wheeze">Wheeze</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput2"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Heart</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->heart}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Heart</label>
                                                    <select id="heart" name="heart"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Murmur">Murmur</option>
                                                        <option value="Irregular Heart Rate">Irregular Heart Rate</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput3"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Abdomen</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->abdomen}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Abdomen</label>
                                                    <select id="abdomen" name="abdomen"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Distended">Distended</option>
                                                        <option value="Tenderness">Tenderness</option>
                                                        <option value="Dysmenorrhea">Dysmenorrhea</option>
                                                        <option value="others">Others, specify</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput4"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Deformities</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->deformities}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deformities</label>
                                                    <select id="deformities" name="deformities"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="others">Congenital (Specify)</option>
                                                    </select>
                                                    <input type="hidden" id="othersInput5"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Please Specify" required />
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Iron Supplementation</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->iron_supplementation}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Iron
                                                        Supplementaion</label>
                                                    <select id="iron_supplementation" name="iron_supplementation"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Deworming</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->deworming}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deworming</label>
                                                    <select id="deworming" name="deworming"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Immunization</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->immunization}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Immunization</label>
                                                    <select id="immunization" name="immunization"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">SBFP Beneficiary</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->sbfp_beneficiary}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">SBFP
                                                        Beneficiary</label>
                                                    <select id="sbfp_beneficiary" name="sbfp_beneficiary"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">4P's Beneficiary</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->four_p_beneficiary}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">4P's
                                                        Beneficiary</label>
                                                    <select id="four_p_beneficiary" name="four_p_beneficiary"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Menarche</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->menarche}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menarche</label>
                                                    <select id="menarche" name="menarche"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Conducted by:</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->nurse->test_name}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Conducted by</label>
                                                    <input type="text" value="{{$nurse->test_name}}"
                                                    id="heart_rate" name="heart_rate"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="72" required />
                                                </div>                                        
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                        <tr>
                            <td class="border p-2 text-center">Remarks:</td>
                            @foreach ($checkupsByGrade as $grade => $checkups )
                                @for ($i = 1; $i<13; $i++)
                                    <td class="border p-2 text-center">
                                        @if ($grade == $i )
                                        {{-- <p>naa ko dre</p> --}}
                                            @foreach ($checkups as $checkup)
                                                {{ $checkup->remarks}}
                                            @endforeach
                                        @else
                                            @if ($i == $student->grade_level)
                                                <div>
                                                    <label for="name"
                                                        class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Remarks</label>
                                                    <select id="remarks" name="remarks"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        required>
                                                        <option value="">Select Value</option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Healthy">Healthy</option>
                                                        <option value="Unhealthy">Unhealthy</option>
                                                    </select>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                @endfor
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <div>
                    <button type="submit" class="w-full text-center mt-2 py-1 px-2 bg-blue-600 text-white rounded-sm cursor-pointer">submit</button>
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
