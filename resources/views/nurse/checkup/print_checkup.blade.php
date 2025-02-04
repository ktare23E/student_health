<x-layout>
    <div class="p-8 bg-blue-100">
        {{-- <a href="{{route('view_student',$student->id)}}" class="bg-white py-1 px-2 rounded sm ">Back</a> --}}
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
                            <td class="border p-2 textcenter">
                                @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                    {{-- Display heart rate data for the grade --}}
                                    @foreach ($checkupsByGrade[$i] as $checkup)
                                        <p class="text-xs">{{ \Carbon\Carbon::parse($checkup->date_of_checkup)->format('F j, Y') }}</p>
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
                                @endif
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td class="border p-2 text-center">Age</td>
                        @for ($i = 1; $i <= 12; $i++)
                            <td class="border p-2 text-center">
                                @if (isset($checkupsByGrade[$i]) && count($checkupsByGrade[$i]) > 0)
                                    {{-- Display heart rate data for the grade --}}
                                    @foreach ($checkupsByGrade[$i] as $checkup)
                                        {{ $checkup->student_age }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ $checkup->adviser_name }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->temperature) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->systolic).'/'.Crypt::decrypt($checkup->diastolic) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->heart_rate) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->pulse_rate) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->respiratory_rate) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->height).' meters' }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->weight).'kg' }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->bmi_weight) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->bmi_height) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->vision_screening) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->auditory_screening) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->skin) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->scalp) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->eyes) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->ears) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->nose) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->mouth) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>

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
                                        {{ Crypt::decrypt($checkup->lungs) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->heart) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->abdomen) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->deformities) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->iron_supplementation) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->deworming) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->immunization) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->sbfp_beneficiary) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->four_p_beneficiary) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->menarche) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ $checkup->nurse->test_name }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
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
                                        {{ Crypt::decrypt($checkup->remarks) }}
                                    @endforeach
                                @else
                                    <p class="text-sm text-center">-</p>
                                @endif
                            </td>
                        @endfor
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
    <script>
        window.onload = function(){
            window.print();
        }
    </script>
    
    
</x-layout>
