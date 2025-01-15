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
                        <input type="text" placeholder="First" class="border p-2 rounded w-1/2" value="{{$student->first_name}}" readonly>
                        <input type="text" placeholder="Last" class="border p-2 rounded w-1/2" value="{{$student->last_name}}" readonly>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">School:</label>
                    <input type="text" placeholder="Enter School ID" class="border p-2 rounded w-full" value="{{$student->school->name}}" readonly>
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
                    <input type="text" placeholder="Enter Region" class="border p-2 rounded w-full" value="{{$student->region}}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Birthplace:</label>
                    <input type="text" placeholder="Enter Birthplace" class="border p-2 rounded w-full" value="{{$student->birth_place}}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Division:</label>
                    <input type="text" placeholder="Enter Division" class="border p-2 rounded w-full" value="{{$student->school->district->division->name}}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Parent/Guardian:</label>
                    <input type="text" placeholder="Enter Parent/Guardian Name" class="border p-2 rounded w-full" value="{{$student->parent_name}}" readonly>
                </div>
                <div>
                    <label class="block font-semibold">Telephone No.:</label>
                    <input type="text" placeholder="Enter Telephone No." class="border p-2 rounded w-full" value="{{$student->cellphone_number}}" readonly>
                </div>
                <div class="col-span-2">
                    <label class="block font-semibold">Address:</label>
                    <input type="text" placeholder="Enter Address" class="border p-2 rounded w-full" value="{{$student->address}}" readonly>
                </div>
            </div>
        </div>

        <!-- Examination Table -->
        <div class="border p-4 bg-white rounded shadow mt-6">
            <table class="table-auto border-collapse w-full text-sm">
                <thead>
                    <tr>
                        <th class="border p-2"></th>
                        <th class="border p-2">Kinder/SPED</th>
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
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">{{ $student->grade_level === '1' ? \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F d, Y') : '-' }}
                        </td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Temperature/BP</td>
                        <td class="border p-2 text-center"></td>
                        <td class="border p-2 text-center">{{$student->grade_level === '1' ? $checkup->temperature.' '.$checkup->systolic.'/'.$checkup->diastolic : '-'}}</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Heart Rate/Pulse Rate/Respiratory Rate</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Height</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Weight</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Nutritional Status (BMI)</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Vision Screening</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Auditory Screening</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Skin/Scalp</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Eyes/Ears/Nose</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Mouth/Throat/Neck</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Lungs/Heart</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Abdomen</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Deformities</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                        <td class="border p-2 text-center">-</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Legend -->
        <div class="border p-4 bg-white rounded shadow mt-6">
            <h3 class="font-semibold">Legend:</h3>
            <ul class="list-disc ml-6">
                <li><strong>NS:</strong> Nutritional Status</li>
                <li><strong>Passed:</strong> Vision/Auditory Screening Passed</li>
                <li><strong>Others:</strong> Additional notes for abnormalities</li>
            </ul>
        </div>
    </div>
</x-layout>
