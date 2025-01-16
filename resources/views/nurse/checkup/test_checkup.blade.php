<x-layout>
    <div class="p-8 bg-gray-100">
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
                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="block font-semibold">Address:</label>
                            <input type="text" placeholder="Enter Address" class="border p-2 rounded w-full"
                                value="{{ $student->address }}" readonly>
                        </div>
                        <div>
                            <label class="block font-semibold">Conducted by:</label>
                            <input type="text" placeholder="Enter Address" class="border p-2 rounded w-full"
                                value="{{ $checkup->nurse->test_name }}" readonly>
                        </div>
                        <div>
                            <label class="block font-semibold">Remarks:</label>
                            <input type="text" placeholder="Enter Address" class="border p-2 rounded w-full"
                                value="{{ $checkup->remarks }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Examination Table -->
        <div class="border p-4 bg-white rounded shadow mt-6">
            <table class="table-auto border-collapse w-full text-sm">
                <thead>
                    <tr>
                        <th class="border p-2"></th>
                        <th class="border p-2">Grade 1/SPED</th>
                        <th class="border p-2">Grade 2/SPED</th>
                        <th class="border p-2">Grade 3/SPED</th>
                        <th class="border p-2">Grade 4/SPED</th>
                        <th class="border p-2">Grade 5/SPED</th>
                        <th class="border p-2">Grade 6/SPED</th>
                        <th class="border p-2">Grade 7/SPED</th>
                        <th class="border p-2">Grade 8/SPED</th>
                        <th class="border p-2">Grade 9/SPED</th>
                        <th class="border p-2">Grade 10/SPED</th>
                        <th class="border p-2">Grade 11/SPED</th>
                        <th class="border p-2">Grade 12/SPED</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Placeholder rows for the table -->
                    <tr>
                        <td class="border p-2 text-center">Date of Examination</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Temperature</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->temperature : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->temperature : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->temperature : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">BP</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->systolic . '/' . $checkup->diastolic : '-' }}</td></td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Heart Rate</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->heart_rate : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->heart_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->heart_rate : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Pulse Rate</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->pulse_rate : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->pulse_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->pulse_rate : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Respiratory Rate</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->respiratory_rate : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->respiratory_rate : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->respiratory_rate : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Height</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->height . ' meters' : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->height . ' meters' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->height . ' meters' : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Weight</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->weight . 'kg' : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->weight . 'kg' : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->weight . 'kg' : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Nutritional Status (BMI)</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->bmi_weight : '-' }}
                        </td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '2' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '3' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '4' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '5' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '6' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '7' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '8' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '9' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '10' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '11' ? $checkup->bmi_weight : '-' }}</td>
                        <td class="border p-2 text-center"> {{ $student->grade_level === '12' ? $checkup->bmi_weight : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Vision Screening</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->vision_screening : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->vision_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->vision_screening : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Auditory Screening</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->auditory_screening : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->auditory_screening : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->auditory_screening : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Skin</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->skin : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->skin : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->skin : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Scalp</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->scalp : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->scalp : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->scalp : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Eyes</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->eyes : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->eyes : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->eyes : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Ears</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->ears : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->ears : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->ears : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Nose</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->nose : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->nose : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->nose : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Mouth</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->mouth : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->mouth : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->mouth : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Lungs</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->lungs : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->lungs : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->lungs : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Heart</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->heart : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->heart : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->heart : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Abdomen</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->abdomen : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->abdomen : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->abdomen : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Deformities</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->deformities : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->deformities : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->deformities : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Iron Supplementation</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->iron_supplementation : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->iron_supplementation : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->iron_supplementation : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Deworming</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->deworming : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->deworming : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->deworming : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Immunization</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->immunization : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->immunization : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->immunization : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">SBFP Beneficiary</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->sbfp_beneficiary : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->sbfp_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->sbfp_beneficiary : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">4P's Beneficiary</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->four_p_beneficiary : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->four_p_beneficiary : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->four_p_beneficiary : '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Menarche</td>
                        <td class="border p-2 text-center">
                            {{ $student->grade_level === '1' ? $checkup->menarche : '-' }}
                        </td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '2' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '3' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '4' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '5' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '6' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '7' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '8' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '9' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '10' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '11' ? $checkup->menarche : '-' }}</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '12' ? $checkup->menarche : '-' }}</td>
                    </tr>
                </tbody>
            </table>
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
</x-layout>
