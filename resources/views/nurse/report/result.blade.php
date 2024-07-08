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
                                <a href="{{ route('report') }}"
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
                                    {{-- <p class="summary text-wrap"></p> --}}
                                </div>
                            </div>
                            <canvas id="reportChart"></canvas>

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
                                            <td class="{{$student->checkups[0]->remarks === 'Healthy' ? 'text-green-500':'text-red-500'}}">{{ $student->checkups[0]->remarks }}</td>
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
    const chartData = @json($chartData);

    const category = chartData.map(data => data.category);
    const labels = chartData.map(data => data.student);
    const values = chartData.map(data => data.value);
    console.log(values);
    // Mapping of string values to numeric
    const valueMapping = {
        'Yes': 1,
        'No': 0
    };

    // Reverse mapping for displaying labels
    const reverseMapping = Object.keys(valueMapping).reduce((obj, key) => {
        obj[valueMapping[key]] = key;
        return obj;
    }, {});

    let label = '';
    let yAxisConfig = {};
    let chartValues;
    let yesCount = 0;
    let noCount = 0;
    let normal_weight = 0;
    let wasted_underweight = 0;
    let overweight = 0;
    let obese = 0;
    let severely_wasted_underweight = 0;
    let passedCount = 0;
    let failedCount = 0;
    let normalCount = 0;
    let rednessCount = 0;
    let whiteSpotsCount = 0;
    let impetigoCount = 0;
    let bruisesCount = 0;
    let skinLessionCount = 0;
    let itchinessCount = 0;
    let acneCount = 0;
    let liceCount = 0;
    let styeCount = 0;
    let eyeRedness = 0;
    let ocularCount = 0;
    let paleCount = 0;
    let eyeDischargeCount = 0;
    let mattedCount = 0;
    let earDischargeCount = 0;
    let impactedCerumenCount = 0;
    let mucusDischargeCount = 0;
    let noseBleedingCount = 0;
    let enlargeTonsilCount = 0;
    let presenceLessionCount = 0;
    let inflamedCount = 0;
    let enlargeCount = 0;
    let otherCount = 0;
    let ralesCount = 0;
    let wheezeCount = 0;
    let mumurCount = 0;
    let irregularHeartCount = 0;
    let distendedCount = 0;
    let tendernessCount = 0;
    let dysmenorrheaCount = 0;


    // Count Yes and No values
    values.forEach(value => {
        if (value === 'Yes') {
            yesCount++;
        } else if (value === 'No') {
            noCount++;
        }else if (value === 'Normal Weight') {
            normal_weight++;
        }else if (value === 'Wasted Underweight') {
            wasted_underweight++;
        }else if (value === 'Overweight') {
            overweight++;
        }else if (value === 'Obese') {
            obese++;
        }else if (value === 'Severely Wasted Underweight') {
            severely_wasted_underweight++;
        }else if (value === 'Passed') {
            passedCount++;
        }else if(value === 'Failed'){
            failedCount++;
        }else if(value === "Normal"){
            normalCount++;
        }else if (value === "Redness of Skin"){
            rednessCount++;
        }else if (value === 'White Spots'){
            whiteSpotsCount++;
        }else if (value === 'Impetigo/Boil'){
            impetigoCount++;
        }else if (value === 'Bruises/Injuries'){
            bruisesCount++;
        }else if (value === 'Skin Lession'){
            skinLessionCount++;
        }else if (value === 'Itchiness'){
            itchinessCount++;
        }else if (value === 'Acne/Pimple'){
            acneCount++;
        }else if (value === 'Presence of Lice'){
            liceCount++;
        }else if (value === 'Stye'){
            styeCount++;
        }else if (value === 'Eye Redness'){
            eyeRedness++;
        }else if (value === 'Ocular Misallignment'){
            ocularCount++;
        }else if (value === 'Pale Conjunctiva'){
            paleCount++;
        }else if (value === 'Eye Discharge'){
            eyeDischargeCount++;
        }else if (value === 'Matted Eyelashes'){
            mattedCount++;
        }else if (value === 'Ear Discharge'){
            earDischargeCount++;
        }else if (value === 'Impacted Cerumen'){
            impactedCerumenCount++;
        }else if (value === 'Mucus Discharge'){
            mucusDischargeCount++;
        }else if (value === 'Nose Bleeding(Eplstaxis)'){
            noseBleedingCount++;
        }else if (value === 'Enlarge Tonsils'){
            enlargeTonsilCount++;
        }else if (value === 'Presence of Lesions'){
            presenceLessionCount++;
        }else if (value === 'Inflamed Pharynx'){
            inflamedCount++;
        }else if (value === 'Enlarge LymphNodes'){
            enlargeCount++;
        }else if (value === 'others'){
            otherCount++;
        }else if (value === 'Rales'){
            ralesCount++;
        }else if (value === 'Wheeze'){
            wheezeCount++;
        }else if (value === 'Murmur'){
            mumurCount++;
        }else if (value === 'Irregular Heart Rate'){
            irregularHeartCount++;
        }else if (value === 'Distended'){
            distendedCount++;
        }else if (value === 'Tenderness'){
            tendernessCount++;
        }else if (value === 'Dysmenorrhea'){
            dysmenorrheaCount++;
        }
    });

    

    const ctx = document.getElementById('reportChart').getContext('2d');

    // Determine the chart type and configuration
    if (category[0] === 'temperature' || category[0] === 'heart_rate' || category[0] === 'pulse_rate' || category[0] === 'respiratory_rate') {
        label = 'Temperature';
        let summary = document.querySelector('.summary');
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: 100,
            ticks: {
                stepSize: 10
            }
        };
        // Use original values for temperature
        chartValues = values;
        let totalValue = 0;
        let count = 0;

        //avg Temperature, string to number
        chartValues.forEach(values =>{
            const temperature = parseFloat(values);
            if (!isNaN(temperature)) {
                totalValue += temperature; // Sum up the temperatures
                count++;
            }
        });

        const avgValue = totalValue / count;
        summary.innerHTML = `<p>Average <span class="font-bold">${category[0] === 'temperature' ? 'Temperature':category[0] === 'heart_rate' ? 'Heart Rate': category[0] === 'pulse_rate' ? 'Pulse Rate': category[0] === 'respiratory_rate' ? 'Respiratory Rate' : ''}</span>: ${avgValue.toFixed(2)}</p>`;
        const reportChart = new Chart(ctx, {
            type: 'line', // or other types like 'bar', 'radar', etc.
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: chartValues, // Use dynamically determined values
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    } else if (category[0] === 'deworming' || category[0] === 'iron_supplementation' || category[0] === 'immunization') {
        label = category[0] === 'deworming' ? 'Deworming' : category[0] === 'iron_supplementation' ? 'Iron Supplementation' : 'Immunization';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">${category[0] === 'iron_supplementation' ? 'Iron Supplmentation': category[0] === 'deworming' ? 'Deworming': category[0] === 'immunization' ? 'Immunization':''}</span>: ${yesCount}</p>
        <p>Total student that has <span class="font-bold">No ${category[0] === 'iron_supplementation' ? 'Iron Supplmentation': category[0] === 'deworming' ? 'Deworming': category[0] === 'immunization' ? 'Immunization':''}</span>: ${noCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(yesCount, noCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [yesCount, noCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Yes', 'No'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if (category[0] === 'bmi_weight'){
        label = "BMI Weight";
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal Weight</span>: ${normal_weight}</p>
                            <p>Total student that has <span class="font-bold">Wasted Underweight</span>: ${wasted_underweight}</p>
                            <p>Total student that has <span class="font-bold">Severely Wasted Underweight</span>: ${severely_wasted_underweight}</p>
                            <p>Total student that has <span class="font-bold">Obese</span>: ${obese}</p> 
                            <p>Total student that has <span class="font-bold">Overweight</span>: ${overweight}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normal_weight,wasted_underweight,severely_wasted_underweight,obese,overweight), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normal_weight,wasted_underweight,severely_wasted_underweight,obese,overweight];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal Weight', 'Wasted Underweight','Severely Wasted Underweight','Obese','Overweight'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if (category[0] === 'vision_screening' || category[0] === 'auditory_screening'){
        label = category[0] === 'vision_screening' ? 'Vision Screening' : 'Auditory Screening';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that passed <span class="font-bold">${category[0] === 'vision_screening' ? 'Vision Screening': 'Auditory Screening'}</span>: ${passedCount}</p>
                            <p>Total student that failed <span class="font-bold">${category[0] === 'vision_screening' ? 'Vision Screening': 'Auditory Screening'}</span>: ${failedCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(passedCount, failedCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [passedCount, failedCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Passed', 'Failed'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if(category[0] === 'skin'){

        label = 'Skin';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Redness of Skin</span>: ${rednessCount}</p>
                            <p>Total student that has <span class="font-bold">White Spots</span>: ${whiteSpotsCount}</p>
                            <p>Total student that has <span class="font-bold">Impetigo/Boil</span>: ${impetigoCount}</p> 
                            <p>Total student that has <span class="font-bold">Bruises/Injuries</span>: ${bruisesCount}</p>
                            <p>Total student that has <span class="font-bold">Skin Lession</span>: ${skinLessionCount}</p>
                            <p>Total student that has <span class="font-bold">Itchiness</span>: ${itchinessCount}</p>
                            <p>Total student that has <span class="font-bold">Acne/Pimple</span>: ${acneCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,rednessCount,whiteSpotsCount,impetigoCount,skinLessionCount,itchinessCount,acneCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,rednessCount,whiteSpotsCount,impetigoCount,skinLessionCount,itchinessCount,acneCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Redness of Skin','White Spots','Impetigo/Boil','Bruises/Injuries','Skin Lession','Itchiness','Acne/Pimple'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if(category[0] === 'scalp'){
        label = 'Scalp';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Itchiness</span>: ${itchinessCount}</p>
                            <p>Total student that has <span class="font-bold">Presence of Lice</span>: ${liceCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,itchinessCount,liceCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,itchinessCount,liceCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Itchiness','Presence of Lice'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if(category[0] === 'eyes'){
        label = 'Eyes';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Stye</span>: ${styeCount}</p>
                            <p>Total student that has <span class="font-bold">Eye Redness</span>: ${eyeRedness}</p>
                            <p>Total student that has <span class="font-bold">Ocular Misallignment</span>: ${ocularCount}</p>
                            <p>Total student that has <span class="font-bold">Pale Conjunctiva</span>: ${paleCount}</p>
                            <p>Total student that has <span class="font-bold">Eye Discharge</span>: ${eyeDischargeCount}</p>
                            <p>Total student that has <span class="font-bold">Matted Eyelashes</span>: ${mattedCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,styeCount,eyeRedness,ocularCount,paleCount,eyeDischargeCount,mattedCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,styeCount,eyeRedness,ocularCount,paleCount,eyeDischargeCount,mattedCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Stye','Eye Redness','Ocular Misallignment','Pale Conjunctiva','Eye Discharge','Matted Eyelashes'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if(category[0] === 'ears'){
        label = 'Ears';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Ear Discharge</span>: ${earDischargeCount}</p>
                            <p>Total student that has <span class="font-bold">Impacted Cerumen</span>: ${impactedCerumenCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,earDischargeCount,impactedCerumenCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,earDischargeCount,impactedCerumenCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Ear Discharge','Impacted Cerumen'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if(category[0] === 'nose'){
        label = 'Nose';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Mucus Discharge</span>: ${mucusDischargeCount}</p>
                            <p>Total student that has <span class="font-bold">Nose Bleeding(Eplstaxis)</span>: ${noseBleedingCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,mucusDischargeCount,noseBleedingCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,mucusDischargeCount,noseBleedingCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Mucus Discharge','Nose Bleeding(Eplstaxis)'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if(category[0] === 'mouth'){
        label = 'Mouth';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Enlarge Tonsils</span>: ${enlargeTonsilCount}</p>
                            <p>Total student that has <span class="font-bold">Presence of Lesions</span>: ${presenceLessionCount}</p>
                            <p>Total student that has <span class="font-bold">Inflamed Pharynx</span>: ${inflamedCount}</p>
                            <p>Total student that has <span class="font-bold">Enlarge LymphNodes</span>: ${enlargeCount}</p>
                            <p>Total student that has <span class="font-bold">Others</span>: ${otherCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,enlargeTonsilCount,presenceLessionCount,inflamedCount,enlargeCount,otherCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,enlargeTonsilCount,presenceLessionCount,inflamedCount,enlargeCount,otherCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Enlarge Tonsils','Presence of Lesions','Inflamed Pharynx','Enlarge LymphNodes','Others'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if(category[0] === 'lungs'){
        label = 'Lungs';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Rales</span>: ${ralesCount}</p>
                            <p>Total student that has <span class="font-bold">Wheeze</span>: ${wheezeCount}</p>
                            <p>Total student that has <span class="font-bold">Others</span>: ${otherCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,ralesCount,wheezeCount,otherCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,ralesCount,wheezeCount,otherCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Rales','Wheeze','Others'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if(category[0] === 'heart'){
        label = 'Heart';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Murmur</span>: ${mumurCount}</p>
                            <p>Total student that has <span class="font-bold">Irregular Heart Rate</span>: ${irregularHeartCount}</p>
                            <p>Total student that has <span class="font-bold">Others</span>: ${otherCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,mumurCount,irregularHeartCount,otherCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,mumurCount,irregularHeartCount,otherCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Murmur','Irregular Heart Rate','Others'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if (category[0] === 'abdomen'){
        label = 'Abdomen';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Distended</span>: ${distendedCount}</p>
                            <p>Total student that has <span class="font-bold">Tenderness</span>: ${tendernessCount}</p>
                            <p>Total student that has <span class="font-bold">Dysmenorrhea</span>: ${dysmenorrheaCount}</p>
                            <p>Total student that has <span class="font-bold">Others</span>: ${otherCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,distendedCount,tendernessCount,dysmenorrheaCount,otherCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,distendedCount,tendernessCount,dysmenorrheaCount,otherCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal', 'Distended','Tenderness','Dysmenorrhea','Others'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }else if (category[0] === 'deformities'){
        label = 'Deformities';
        let summary = document.querySelector('.summary');
        summary.innerHTML = `<p>Total student that has <span class="font-bold">Normal</span>: ${normalCount}</p>
                            <p>Total student that has <span class="font-bold">Others</span>: ${otherCount}</p>`;
        yAxisConfig = {
            beginAtZero: true,
            min: 0,
            max: Math.max(normalCount,otherCount), // Ensure the y-axis max accommodates the counts
            ticks: {
                stepSize: 1
            }
        };

        // Prepare the data for the bar chart
        chartValues = [normalCount,otherCount];
        const reportChart = new Chart(ctx, {
            type: 'bar', // Bar chart for deworming or iron supplementation
            data: {
                labels: ['Normal','Others'],
                datasets: [{
                    label: label,
                    data: chartValues, // Use the counts of Yes and No
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: yAxisConfig // Apply the dynamic y-axis configuration
                }
            }
        });
    }

</script>



    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
