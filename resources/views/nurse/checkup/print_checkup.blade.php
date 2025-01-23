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
                                            {{ $checkup->temperature }}
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
                                            {{ $checkup->systolic.'/'.$checkup->diastolic }}
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
                                            {{ $checkup->heart_rate }}
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
                                            {{ $checkup->pulse_rate }}
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
                                            {{ $checkup->respiratory_rate }}
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
                                            {{ $checkup->height.' meters' }}
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
                                            {{ $checkup->weight.'kg' }}
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
                                            {{ $checkup->bmi_weight }}
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
                                            {{ $checkup->bmi_height }}
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
                                            {{ $checkup->vision_screening }}
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
                                            {{ $checkup->auditory_screening }}
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
                                            {{ $checkup->skin }}
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
                                            {{ $checkup->scalp }}
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
                                            {{ $checkup->eyes }}
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
                                            {{ $checkup->ears }}
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
                                            {{ $checkup->nose }}
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
                                            {{ $checkup->mouth }}
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
                                            {{ $checkup->lungs }}
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
                                            {{ $checkup->heart }}
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
                                            {{ $checkup->abdomen }}
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
                                            {{ $checkup->deformities }}
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
                                            {{ $checkup->iron_supplementation }}
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
                                            {{ $checkup->deworming }}
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
                                            {{ $checkup->immunization }}
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
                                            {{ $checkup->sbfp_beneficiary }}
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
                                            {{ $checkup->four_p_beneficiary }}
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
                                            {{ $checkup->menarche }}
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
                                            {{ $checkup->remarks }}
                                        @endforeach
                                    @else
                                        <p class="text-sm text-center">-</p>
                                    @endif
                                </td>
                            @endfor
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
    <script>
        $(document).ready(function () {
            const whoData = {
                5: { median: 1.10, sd: 0.05 },
                6: { median: 1.15, sd: 0.05 },
                7: { median: 1.20, sd: 0.06 },
                8: { median: 1.27, sd: 0.06 },
                9: { median: 1.33, sd: 0.07 },
                10: { median: 1.38, sd: 0.07 },
                11: { median: 1.43, sd: 0.07 },
                12: { median: 1.48, sd: 0.08 },
                13: { median: 1.54, sd: 0.08 },
                14: { median: 1.59, sd: 0.07 },
                15: { median: 1.63, sd: 0.08 },
                16: { median: 1.66, sd: 0.08 },
                17: { median: 1.68, sd: 0.08 },
                18: { median: 1.70, sd: 0.09 },
                19: { median: 1.71, sd: 0.09 },
                20: { median: 1.72, sd: 0.09 },
            };

            $('#age, #height').on('input', function () {
                const age = parseInt($('#age').val());
                const height = parseFloat($('#height').val());

                if (whoData[age] && height) {
                    const median = whoData[age].median;
                    const sd = whoData[age].sd;

                    const zScore = (height - median) / sd;
                    let nutritionalStatus = '';

                    if (zScore >= -2) {
                        nutritionalStatus = 'Normal Height';
                    } else if (zScore < -3) {
                        nutritionalStatus = 'Severely Stunted';
                    } else {
                        nutritionalStatus = 'Stunted';
                    }

                    // Set the <select> value based on the calculated status
                    $('#bmi_height').val(nutritionalStatus);
                } else {
                    // Reset the <select> field if inputs are invalid
                    $('#bmi_height').val('');
                }
            });
        });

    </script>
</x-layout>
