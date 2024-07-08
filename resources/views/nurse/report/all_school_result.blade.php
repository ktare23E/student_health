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
                                <a href="{{ route('district_nurse_dashboard') }}"
                                    class="text-blue-600 hover:text-blue-800 hover:underline">Home</a>
                            </li>
                            <li>
                                <span class="px-1">></span>
                            </li>
                            <li>
                                <a href="{{ route('district_report') }}"
                                    class="text-blue-600 hover:text-blue-800 hover:underline">Report</a>
                            </li>
                            <li>
                                <span class="px-1">></span>
                            </li>
                            <li>
                                <a href="" class="text-blue-600 hover:text-blue-800 hover:underline">Filter
                                    Result
                                </a>
                            </li>

                        </ol>
                    </nav>



                    <div class="flex flex-col p-[2rem] w-full">
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto">
                            <h1 class="font-bold text-2xl mb-4">Data Analytics</h1>
                            <div>

                                <div class="">
                                    <h1 class="font-bold text-xl">Summary:</h1>
                                    <div class="summary">

                                    </div>

                                </div>
                            </div>
                            <canvas id="schoolChart"></canvas>

                        </div>
                        <div class="bg-white rounded-md shadow-lg px-6 py-4 w-full mx-auto mt-12">
                            <h1 class="font-bold text-2xl mb-4">Students</h1>
                            <table id="myTable2" class="display">
                                <thead>
                                    <tr>
                                        <th>Student LRN</th>
                                        <th>Student Name</th>
                                        <th>Grade Level</th>
                                        <th>Adviser</th>
                                        <th>School</th>
                                        <th>Checkup Remarks</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr class="text-sm">
                                            <td>{{ $student->student_lrn }}</td>
                                            <td>{{ $student->first_name . ' ' . $student->last_name }}</td>
                                            <td>{{ 'Grade ' . $student->grade_level }}</td>
                                            <td>{{ $student->checkups[0]->adviser_name }}</td>
                                            <td>{{ $student->school->name }}</td>
                                            <td
                                                class="{{ $student->checkups[0]->remarks === 'Healthy' ? 'text-green-500' : 'text-red-500' }}">
                                                {{ $student->checkups[0]->remarks }}</td>
                                            {{-- <td>

                                                <button class="text-sm py-1 px-2 rounded-sm bg-black text-white">
                                                    <a href="{{ route('view_student', $student->id) }}">view</a>
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Include Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Include Chart.js Date Adapter for Moment.js -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0/dist/chartjs-adapter-moment.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
    </script>
    <script>
        var ctx = document.getElementById('schoolChart').getContext('2d');
        var data = @json($chartData);
        let summary = $('.summary');
        let category = data[0].category;

        var labels = data.map(item => item.school);

        //check if duplicate school name if duplicated make it one
        var uniqueSchools = labels.filter((v, i, a) => a.indexOf(v) === i);

        if (category === 'temperature' || category === 'pulse_rate' || category === 'heart_rate' || category ===
            'respiratory_rate') {
            let label = category === 'temperature' ? 'Temperature' : category === 'pulse_rate' ? 'Pulse Rate' : category ===
                'heart_rate' ? 'Heart Rate' : 'Respiratory Rate';
            // Step 1: Group the data by school
            let schoolData = {};
            data.forEach(function(item) {
                // Parse the value as a float
                let value = parseFloat(item.value);
                if (!isNaN(value)) {
                    if (!schoolData[item.school]) {
                        schoolData[item.school] = [];
                    }
                    schoolData[item.school].push(value);
                }
            });

            // Step 2: Calculate the average for each school
            let schoolAverages = {};
            for (let school in schoolData) {
                let total = schoolData[school].reduce((acc, val) => acc + val, 0);
                schoolAverages[school] = total / schoolData[school].length;
            }

            //display school average in the summary
            for (let school in schoolAverages) {
                summary.append(
                    `<p class="pl-10">${school}, student <span class="lowercase font-bold">average ${label}</span>: ${schoolAverages[school] === 0 ? 'No data yet':schoolAverages}</p>`
                );
            }

            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: uniqueSchools,
                    datasets: [{
                        label: label,
                        data: schoolAverages,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            max: 100,
                            ticks: {
                                stepSize: 10
                            }
                        }
                    }
                }
            });
        } else if (category === 'bmi_weight' || category === 'bmi_height' || category === 'vision_screening' || category === 'auditory_screening' || category === 'skin' || category === 'scalp' || category === 'eyes' || category === 'ears' || category === 'nose' || category === 'mouth' || category === 'lungs' || category === 'heart' || category === 'abdomen' || category === 'deformities' || category === 'iron_supplementation' || category === 'deworming' || category === 'immunization') {
          
            let label = category === 'bmi_weight' ? 'BMI Weight' : category === 'bmi_height' ? 'BMI Height' : category === 'vision_screening' ? 'Vision Screening' : category === 'auditory_screening' ? 'Auditory Screening' : category === 'skin' ? 'Skin' : category === 'scalp' ? 'Scalp' : category === 'eyes' ? 'Eyes' : category === 'ears' ? 'Ears' : category === 'nose' ? 'Nose' : category === 'mouth' ? 'Mouth' : category === 'lungs' ? 'Lungs' : category === 'heart' ? 'Heart' : category === 'abdomen' ? 'Abdomen' : category === 'deformities' ? 'Deformities' : category === 'iron_supplementation' ? 'Iron Supplementation' : category === 'deworming' ? 'Deworming' : 'Immunization';
            let schoolData = {};
            data.forEach(function(item) {
                let school = item.school;
                let value = item.value;

                if (!schoolData[school]) {
                    schoolData[school] = {};
                }

                if (value !== 0) {
                    if (!schoolData[school][value]) {
                        schoolData[school][value] = 0;
                    }
                    schoolData[school][value]++;
                } else {
                    if (!schoolData[school][value]) {
                        schoolData[school][value] = 0;
                    }
                    schoolData[school][value] = 0; // explicitly set to 0 if not already
                }
            });

            // Step 2: Determine the string with the highest frequency for each school, considering non-zero values only
            let schoolAverages = {};
            for (let school in schoolData) {
                let maxCount = 0;
                let mostFrequentValue = 0;

                for (let value in schoolData[school]) {
                    if (value !== "0" && schoolData[school][value] > maxCount) {
                        maxCount = schoolData[school][value];
                        mostFrequentValue = value;
                    }
                }

                // If there were non-zero values, store the most frequent one. Otherwise, keep it 0.
                if (maxCount > 0) {
                    schoolAverages[school] = {
                        mostFrequentValue,
                        count: maxCount
                    };
                } else {
                    schoolAverages[school] = {
                        mostFrequentValue: 0,
                        count: 0
                    };
                }
            }

            // Step 3: Prepare the data for Chart.js
            let uniqueSchools = Object.keys(schoolAverages);
            let counts = uniqueSchools.map(school => schoolAverages[school].count);
            let mostFrequentValues = uniqueSchools.map(school => schoolAverages[school].mostFrequentValue);

           //display school average in the summary
            for (let school in schoolAverages) {
                summary.append(
                    `<p class="pl-10">${school}, student <span class="lowercase font-bold">average ${label}</span>: ${schoolAverages[school].mostFrequentValue === 0 ? 'No data yet': schoolAverages[school].mostFrequentValue === 'No' ? `Students no ${label} yet`: schoolAverages[school].mostFrequentValue}</p>`
                );
            }

            // , with a total count: ${schoolAverages[school].count}

            // Step 4: Create the chart
            const myChart = new Chart(ctx, {
                type: 'line', // or any other chart type
                data: {
                    labels: uniqueSchools,
                    datasets: [{
                        label: label,
                        data: counts, // Corresponding to y-axis
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            max: 50,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let school = context.label;
                                    let count = context.raw;
                                    let mostFrequentValue = schoolAverages[school].mostFrequentValue === 0 ? 'No data yet': schoolAverages[school].mostFrequentValue;
                                    return `Value: ${mostFrequentValue}, Count: ${count}`;
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>




    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
