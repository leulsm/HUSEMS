@extends('student.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Upcoming Exam</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('student.upcomingexam.index') }}">Upcoming Exam</a>
                </div>
                {{-- <div class="breadcrumb-item">Upcoming Exam</div> --}}
            </div>
        </div>

        <div class="row">
            @if ($examSetups)
                @foreach ($examSetups as $examSetup)
                    <div class="col-md-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="far fa-question-circle"></i>
                                </div>
                                <h4>{{ $examSetup->exam_title }}</h4>
                                <div class="card-description">{{ $examSetup->exam_type }}</div>
                            </div>
                            <div class="card-body p-3">

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">

                                            <a class="ticket-item">
                                                <div class="ticket-title">
                                                    <h4>Total Mark</h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div>{{ $examSetup->pass_mark }}</div>
                                                </div>
                                            </a>

                                        </div>
                                        <div class="col-6">
                                            <a class="ticket-item">
                                                <div class="ticket-title">
                                                    <h4>Pass Mark</h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div>{{ $examSetup->pass_mark }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">

                                            <a class="ticket-item">
                                                <div class="ticket-title">
                                                    <h4>Duration of Exam</h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div>{{ $examSetup->duration_time }}</div>
                                                </div>
                                            </a>

                                        </div>

                                    </div>
                                    {{-- @if ($examSetup->schedule)
                                        <div class="row">
                                            <div class="col-6">

                                                <a class="ticket-item">
                                                    <div class="ticket-title">
                                                        <h4>Time Remaining</h4>
                                                    </div>
                                                    <div class="ticket-info">
                                                        <div>{{ $examSetup->duration_time }}</div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif --}}
                                    {{-- @if ($examSetup->schedule)
                                        <div class="row"> --}}
                                    {{-- <div class="col-6">
                                                <a class="ticket-item">
                                                    <div class="ticket-title">
                                                        <h4>Time Remaining</h4>
                                                    </div>
                                                    <div class="ticket-info">
                                                        <div id="countdown"></div>
                                                        <div id="countdown1"></div>
                                                        <div id="countdown2"></div>
                                                        <div id="countdown3"></div>
                                                    </div>
                                                </a>

                                            </div>
                                        </div> --}}
                                    {{-- <script>
                                            // Get the starting datetime string from the server
                                            var startingDatetimeString = "{{ $examSetup->schedule->starting_datetime }}";

                                            // Parse the starting datetime string to create a Date object
                                            var startTime = new Date(startingDatetimeString).getTime();


                                            // Update the countdown timer every second
                                            var x = setInterval(function() {
                                                // Get the current time
                                                var now = new Date().getTime();
                                                var days1 = Math.floor(now / (1000 * 60 * 60 * 24));
                                                var hours1 = Math.floor((now % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                var minutes1 = Math.floor((now % (1000 * 60 * 60)) / (1000 * 60));
                                                var seconds1 = Math.floor((now % (1000 * 60)) / 1000);
                                                var formattedTime1 = hours1 + ":" + minutes1 + ":" + seconds1;

                                                var days2 = Math.floor(startTime / (1000 * 60 * 60 * 24));
                                                var hours2 = Math.floor((startTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                var minutes2 = Math.floor((startTime % (1000 * 60 * 60)) / (1000 * 60));
                                                var seconds2 = Math.floor((startTime % (1000 * 60)) / 1000);
                                                var formattedTime2 = hours2 + ":" + minutes2 + ":" + seconds2;

                                                // Calculate the time remaining in milliseconds
                                                var distance = startTime - now;
                                                document.getElementById("countdown1").innerHTML = formattedTime2;
                                                document.getElementById("countdown2").innerHTML = formattedTime1;
                                                document.getElementById("countdown3").innerHTML = distance;


                                                // Calculate days, hours, minutes, and seconds
                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                var formattedTime = hours + ":" + minutes + ":" + seconds;

                                                // Display the countdown timer
                                                document.getElementById("countdown").innerHTML = days + "d " + hours + "h " +
                                                    minutes + "m " + seconds + "s ";

                                                // If the countdown is over, display a message
                                                if (distance < 0) {
                                                    clearInterval(x);
                                                    document.getElementById("countdown").innerHTML = "EXAM STARTED";
                                                }
                                            }, 1000);
                                        </script> --}}
                                    {{-- <script>
                                            // Get the start time of the exam from the server
                                            var startTime = new Date("{{ $examSetup->schedule->starting_datetime }}").getTime();

                                            // Update the countdown timer every second
                                            var x = setInterval(function() {
                                                // Get the current time
                                                var now = new Date().getTime();

                                                // Calculate the time remaining in seconds
                                                var distance = startTime - now;

                                                // Calculate days, hours, minutes, and seconds
                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                // Display the countdown timer
                                                document.getElementById("countdown").innerHTML = days + "d " + hours + "h " +
                                                    minutes + "m " + seconds + "s ";

                                                // If the countdown is over, display a message
                                                if (distance < 0) {
                                                    clearInterval(x);
                                                    document.getElementById("countdown").innerHTML = "EXAM STARTED";
                                                }
                                            }, 1000);
                                        </script> --}}
                                    {{-- @endif --}}


                                </div>

                            </div>
                            @if ($examSetup->schedule)
                                <a href="{{ route('student.upcomingexam.show', $examSetup->id) }}" class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="GET" class="dropzone" id="mydropzone">
                                                <div class="mx-auto my-3 add-question" id="startButton">View</div>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <p>Not Scheduled Yet.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>No upcoming exam found.</h4>
                        </div>
                    </div>
                </div>
            @endif
    </section>
    <script>
        function updateCountdown() {
            var countdownElement = document.getElementById('countdown');
            var timeRemainingToStart = parseInt(countdownElement.textContent);

            if (timeRemainingToStart > 0) {
                var startButton = document.getElementById('startButton');
                startButton.style.display = 'none';
                startButton.disabled = true;
                timeRemainingToStart--;
                countdownElement.textContent = timeRemainingToStart;
            } else {
                var startButton = document.getElementById('startButton');
                startButton.style.display = 'block'; // Show the Start button
                startButton.disabled = false; // Enable the Start button
                clearInterval(countdownInterval);

            }
            //countdownElement.textContent = timeRemainingToStart;
        }


        // Call the updateCountdown function initially
        updateCountdown();

        // Periodically call the updateCountdown function every second (adjust the interval as needed)
        setInterval(updateCountdown, 1000);
    </script>
    <!-- <script>
        function updateCountdown() {
            var countdownElement = document.getElementById('countdown');
            var timeRemainingFormatted = countdownElement.textContent;
            var timeComponents = timeRemainingFormatted.split(':');

            var days = parseInt(timeComponents[0]);
            var hours = parseInt(timeComponents[1]);
            var minutes = parseInt(timeComponents[2]);
            var seconds = parseInt(timeComponents[3]);

            if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
                // Countdown reached zero, stop updating
                clearInterval(countdownInterval);
            }

            if (seconds === 0) {
                if (minutes === 0) {
                    if (hours === 0) {
                        if (days > 0) {
                            // Countdown reached zero at the end of a day, adjust days and reset time
                            days--;
                            hours = 23;
                            minutes = 59;
                            seconds = 59;
                        }
                    } else {
                        // Countdown reached zero at the end of an hour, adjust hours and reset time
                        hours--;
                        minutes = 59;
                        seconds = 59;
                    }
                } else {
                    // Countdown reached zero at the end of a minute, adjust minutes and reset time
                    minutes--;
                    seconds = 59;
                }
            } else {
                // Decrease seconds by 1
                seconds--;
            }

            var updatedTimeRemainingFormatted = sprintf("%02d:%02d:%02d:%02d", days, hours, minutes, seconds);
            countdownElement.textContent = updatedTimeRemainingFormatted;
        }

        // Call the updateCountdown function initially
        updateCountdown();

        // Update the countdown every second
        var countdownInterval = setInterval(updateCountdown, 1000);
    </script> -->

    <!-- <script>
        function updateCountdown() {
            var countdownElement = document.getElementById('countdown');
            var timeRemainingToStart = parseInt(countdownElement.textContent);

            if (timeRemainingToStart > 0) {
                var days = Math.floor(timeRemainingToStart / (24 * 60 * 60));
                var hours = Math.floor((timeRemainingToStart % (24 * 60 * 60)) / (60 * 60));
                var minutes = Math.floor((timeRemainingToStart % (60 * 60)) / 60);
                var seconds = timeRemainingToStart % 60;

                // Format the countdown values
                var countdownFormatted = days + ' days, ' + hours + ' :' + minutes + ' :' + seconds + ' seconds';

                // Update the countdown text
                countdownElement.textContent = countdownFormatted;
            } else {
                clearInterval(countdownInterval); // Stop the countdown when it reaches 0
                countdownElement.textContent = '0 days 0 : 0 : 0 Seconds'; // Display 0 when countdown ends
            }
        }

        // Call the updateCountdown function initially
        updateCountdown();

        // Periodically call the updateCountdown function every second (adjust the interval as needed)
        var countdownInterval = setInterval(updateCountdown, 1000);
    </script> -->
@endsection
