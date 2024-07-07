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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr class="text-sm">
                                            <td>{{ $student->student_lrn }}</td>
                                            <td>{{ $student->first_name . ' ' . $student->last_name }}</td>
                                            <td>{{ 'Grade ' . $student->grade_level }}</td>
                                            <td>

                                                <button class="text-sm py-1 px-2 rounded-sm bg-black text-white">
                                                    <a href="{{ route('view_student', $student->id) }}">view</a>
                                                </button>
                                            </td>
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
        let container = [];
        let yAxisConfig = {};
        let chartValues;

        const ctx = document.getElementById('reportChart').getContext('2d');


        // Determine the y-axis configuration and data values
        if (category[0] === 'temperature') {
            // console.log('temperature');
            label = 'Temperature';
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
        } else if (category[0] === 'deworming') {
            container.push('Yes', 'No');
            label = 'Deworming';
            yAxisConfig = {
                ticks: {
                    callback: function(value) {
                        return reverseMapping[value] || value; // Display string labels
                    }
                }
            };
            // Convert values to numeric
            chartValues = values.map(val => valueMapping[val]);
        } else {
            // Handle other categories if needed
            label = 'Other Data';
            yAxisConfig = {
                // Default y-axis configuration
            };
            chartValues = values; // Use original values for other categories
        }

      
    </script>

    <script src="{{ mix('js/app.js') }}"></script>
</x-layout>
