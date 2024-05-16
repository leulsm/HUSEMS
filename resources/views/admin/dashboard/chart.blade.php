<div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Colleges and Departments</div>
                    <div class="card-body">
                        <canvas id="collegesDepartmentsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Exam Coordinators, Exam Setups, and Schedules</div>
                    <div class="card-body">
                        <canvas id="examDataChart"></canvas>
                    </div>
                </div>
            </div>
            </div>
      

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var chartLabels = @json($chartLabels);
            var chartData = @json($chartData);

            var collegesDepartmentsChart = new Chart(document.getElementById('collegesDepartmentsChart'), {
                type: 'bar',
                data: {
                    labels: chartLabels.slice(0, 2),
                    datasets: [{
                        label: 'Count',
                        data: chartData.slice(0, 2),
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });

            var examDataChart = new Chart(document.getElementById('examDataChart'), {
                type: 'bar',
                data: {
                    labels: chartLabels.slice(2),
                    datasets: [{
                        label: 'Count',
                        data: chartData.slice(2),
                        backgroundColor: 'rgba(192, 75, 192, 0.5)',
                        borderColor: 'rgba(192, 75, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });
        });
    </script>