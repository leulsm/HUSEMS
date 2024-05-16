@extends('student.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam Setup</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('student.upcomingexam.index') }}">Upcoming Exam</a>
                </div>

                <div class="breadcrumb-item active">Exam Detail</div>
            </div>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Exam Title : {{ $examSetup->exam_title }}</h2>
                                <div class="invoice-number">Exam #{{ $examSetup->id }}</div>
                            </div>
                            <hr>
                            <div class="row mb-4">
                                <p><strong>Instructions</strong></p>
                                <div class="col-12">
                                    <div>Wait Untill Start Button Shows up</div>
                                    <div>No Cheating</div>
                                    <div>Dont Try to open new tab</div>
                                    <div>Dont Try to go out of your exam tab, it will lead to disqualification of your exam
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Exam Type:</strong><br>
                                        {{ $examSetup->exam_type }}<br>
                                        Total Mark: <br>
                                        {{ $examSetup->total_mark }}<br>
                                        Pass Mark:<br>
                                        {{ $examSetup->pass_mark }}
                                    </address>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Duration:</strong><br>
                                        {{ $examSetup->duration_time }}
                                        <br>

                                    </address>
                                </div>
                                {{-- <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Duration Time: </strong><br>
                                        {{ $examSetup->duration_time }}<br><br>
                                        <strong>Starttime Time: </strong><br>
                                        {{ $start_time }}<br><br>
                                        <strong>Now : </strong><br>
                                        {{ $currentTime }}<br><br>
                                    </address>
                                </div> --}}
                                {{-- <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Remaining Time: </strong><br>
                                        {{ $start_time }}<br><br>
                                        </addres>

                                </div> --}}
                                <div class="col-md-6 text-md-left">
                                    <address>
                                        <strong>Remaining Time: </strong><br>
                                        <span id="remaining-time">{{ $remainingTime }}</span><br><br>


                                        {{-- <a id="start-button" class="btn btn-primary d-none"
                                            href="{{ route('student.upcomingexam.create', ['examSetupId' => $examSetup->id]) }}">Start
                                            Exam</a> --}}

                                        <button class="btn btn-primary" id="start-exam-button">Start Exam</button>

                                        <script>
                                            document.getElementById('start-exam-button').addEventListener('click', function() {
                                                // Prompt the user to enter the exam password
                                                let password = prompt("Please enter the exam password:");

                                                if (password) {
                                                    // Proceed with password validation if a password was entered
                                                    validatePassword(password);
                                                }
                                            });

                                            function validatePassword(password) {
                                                // Example examSetupId, replace with the actual value from your context
                                                let examSetupId = "{{ $examSetup->id }}";

                                                // CSRF token
                                                let csrfToken = "{{ csrf_token() }}";

                                                // AJAX request to validate the password
                                                fetch('{{ route('student.validateExamPassword') }}', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': csrfToken
                                                        },
                                                        body: JSON.stringify({
                                                            password: password,
                                                            examSetupId: examSetupId
                                                        })
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (data.valid) {
                                                            // Redirect to the exam start page if password is valid
                                                            window.location.href =
                                                                "{{ route('student.upcomingexam.create', ['examSetupId' => $examSetup->id]) }}";
                                                        } else {
                                                            // Show an alert if the password is incorrect
                                                            alert("Incorrect password. Please try again.");
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error('Error:', error);
                                                        alert("An error occurred. Please try again.");
                                                    });
                                            }
                                        </script>

                                    </address>
                                </div>

                                <script>
                                    // Function to update the remaining time display
                                    function updateRemainingTime(remainingTimeSpan, remainingTime) {
                                        if (remainingTime > 0) {
                                            remainingTime--; // Decrement the remaining time each second

                                            var days = Math.floor(remainingTime / (3600 * 24));
                                            var hours = Math.floor((remainingTime % (3600 * 24)) / 3600);
                                            var minutes = Math.floor((remainingTime % 3600) / 60);
                                            var seconds = remainingTime % 60;

                                            var countdown = '';
                                            if (days > 0) {
                                                countdown += days + 'd ';
                                            }
                                            if (hours > 0 || days > 0) {
                                                countdown += hours + 'h ';
                                            }
                                            if (minutes > 0 || hours > 0 || days > 0) {
                                                countdown += minutes + 'm ';
                                            }
                                            countdown += seconds + 's';

                                            remainingTimeSpan.textContent = countdown; // Update the remaining time display
                                        } else {
                                            clearInterval(intervalId); // Stop the countdown when remaining time reaches zero
                                            remainingTimeSpan.textContent = '00:00:00';
                                            document.getElementById('start-button').classList.remove('d-none');
                                            // document.querySelector('.start-link').parentNode.classList.remove('d-none');
                                        }
                                    }

                                    // Get the remaining time span and initial remaining time from the HTML
                                    var remainingTimeSpan = document.getElementById('remaining-time');
                                    var remainingTime = parseInt(remainingTimeSpan.textContent);

                                    // Update the remaining time every second
                                    var intervalId = setInterval(function() {
                                        updateRemainingTime(remainingTimeSpan, remainingTime);
                                        remainingTime--; // Decrement the remaining time each second
                                    }, 1000);
                                </script>

                            </div>
                        </div>


                    </div>
                    <hr>

                </div>
            </div>

    </section>
@endsection
