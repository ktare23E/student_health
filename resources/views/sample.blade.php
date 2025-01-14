<!DOCTYPE html>
<html>
<head>
    <title>Chart.js Custom y-Axis Labels</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line', // or any other chart type
            data: {
                labels: ['Student 1', 'Student 2', 'Student 3', 'Student 4'],
                datasets: [{
                    label: 'Sample Data',
                    data: [1, 4, 2, 4], // Corresponding to y-axis
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
            options: {
                scales: {
                    y: {
                        ticks: {
                            stepSize: 1,
                            min: 1,
                            max: 4,
                            callback: function(value, index, values) {
                                const labels = {
                                    1: 'Very Low',
                                    2: 'Low',
                                    3: 'Medium',
                                    4: 'High'
                                };
                                return labels[value] || value; // Return label or default to value
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
