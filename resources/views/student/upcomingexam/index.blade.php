@extends('student.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Upcoming Exam</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('student.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Upcoming Exam</div>
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
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Date and Time</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div>{{ $examSetup->date }} {{ $examSetup->time }}</div>
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
                            <div class="row">
                                <div class="col-12">
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Time Left</h4>
                                        </div>
                                        <div>

                                        <div class="ticket-info">
                                            @if ($timeRemainingToStart)
                                                <h4>Time Remaining: <span id="countdown">
                                                <div>
                                                <h4>{{ $timeRemainingToStart }}</h4>
                                                </div>
                                                    </span></h4>
                                            @else
                                                <h4>Not Scheduled yet!</h4>
                                            @endif
                                        </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <a class="ticket-item">
                                                <div class="ticket-title">
                                                    <h4>Total Mark</h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div>{{ $examSetup->total_mark }}</div>
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
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="ticket-item">
                                                <div class="ticket-title">
                                                    <h4>Time Left</h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div>{{ $examSetup->duration_time }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="{{ route('student.upcomingexam.create', ['examSetupId' => $examSetup->id]) }}"
                                        class="">
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="GET" class="dropzone" id="mydropzone">
                                                    <div class="mx-auto my-3 add-question">Start</div>
                                                </form>
                                            </div>
                                        </div>


                                    </a>
                                </div>
                            </div>

                            </div>
                            <a href="{{ route('student.upcomingexam.create', ['examSetupId' => $examSetup->id]) }}"
                                class="">
                                <div class="row">
                                    <div class="col-12">
                                        <form action="GET" class="dropzone" id="mydropzone">
                                            <div class="mx-auto my-3 add-question">Start</div>
                                        </form>
                                    </div>
                                </div>
                            </a>
                            </div>
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
        </div>
    </section>




           <script>
    function updateCountdown() {
        var countdownElement = document.getElementById('countdown');
        var timeRemainingToStart = parseInt(countdownElement.textContent);

        if (timeRemainingToStart > 0) {
            timeRemainingToStart--;
            countdownElement.textContent = timeRemainingToStart;
        }
        countdownElement.textContent = timeRemainingToStart;
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
