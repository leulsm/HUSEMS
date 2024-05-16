<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>HUSEMS</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

    {{-- <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script> --}}
    <!-- /END GA -->
    <style>
        .no-select {
            -webkit-user-select: none;
            /* Safari */
            -moz-user-select: none;
            /* Firefox */
            -ms-user-select: none;
            /* IE/Edge */
            user-select: none;
            /* Standard */
        }
    </style>

</head>

<body oncontextmenu="return false;" onkeydown="return false;">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <ul class="navbar-nav navbar-right">

                </ul>
            </nav>
            <div class="main-content1">
                {{-- <script src="{{ asset('admin/assets/js/lockdown.js') }}"></script> --}}

                <section class="section">
                    <div class="section-header">
                        <h1>Exam</h1>
                        <div class="section-header-breadcrumb">
                            {{-- <div class="breadcrumb-item active">
                                <p>Controll time: <span id="current-time">{{ $endTimeFormatted }}</span></p>
                            </div> --}}

                            <div class="breadcrumb-item active">
                                {{ $endTime }}
                                <p>now: <span id="remaining-time2"></span></p>
                                <p>curr: <span id="remaining-time3"></span></p>

                                <p>Chek: <span id="remaining-time1"></span></p>
                                <p>Time:
                                    <span id="remaining-time"></span>

                                </p>
                            </div>

                        </div>
                    </div>
                </section>
                <div class="row mt-5">
                    <div class="col-12 col-sm-7 col-lg-7">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-4">
                                <h3>Questions</h3>
                                <div class="question-list-container" style="height: 400px; overflow-y: auto;">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        @foreach ($questions as $key => $question)
                                            <li class="nav-item">
                                                <a class="nav-link{{ $question->id == session('active_question') || ($key == 0 && !session('active_question')) ? ' active' : '' }}"
                                                    id="question-tab{{ $key }}" data-toggle="tab"
                                                    href="#question{{ $key }}" role="tab"
                                                    aria-controls="question{{ $key }}"
                                                    aria-selected="{{ $question->id == session('active_question') || ($key == 0 && !session('active_question')) ? 'true' : 'false' }}">
                                                    {{ $question->question_text }}
                                                    @php
                                                        $submitted = App\Models\ExamTaken::where(
                                                            'student_id',
                                                            Auth::id(),
                                                        )
                                                            ->where('question_id', $question->id)
                                                            ->exists();
                                                    @endphp

                                                    @if ($submitted)
                                                        <i class="fas fa-check"></i>
                                                        <!-- Show a tick icon if the question is submitted -->
                                                    @endif

                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-8">
                                <h3>_______//_________</h3>
                                <div class="tab-content no-padding" id="myTab2Content">
                                    @foreach ($questions as $key => $question)
                                        <div class="tab-pane fade{{ $question->id == session('active_question') || ($key == 0 && !session('active_question')) ? ' show active' : '' }}"
                                            id="question{{ $key }}" role="tabpanel"
                                            aria-labelledby="question-tab{{ $key }}">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>{{ $loop->iteration }}, {{ $question->question_text }}</p>
                                                </div>
                                            </div>
                                            <form method="POST" action="{{ route('student.upcomingexam.store') }}">
                                                @csrf
                                                {{-- <div class="row">
                                                    <input type="hidden" name="question_id"
                                                        value="{{ $question->id }}">
                                                    <input type="hidden" name="exam_setup_id"
                                                        value="{{ $examSetup->id }}">
                                                    @foreach ($question->answerOptions as $key => $answerOption)
                                                        @php
                                                            $alphabet = chr(65 + $key); // Convert index to corresponding alphabet (A, B, C, ...)
                                                        @endphp
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="answer_option_id"
                                                                    id="answerOption{{ $key }}"
                                                                    value="{{ $answerOption->id }}">
                                                                <label class="form-check-label"
                                                                    for="answerOption{{ $key }}">
                                                                    {{ $alphabet }}.
                                                                    {{ $answerOption->option_text }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div> --}}


                                                {{-- <div class="row">
                                                    <input type="hidden" name="question_id"
                                                        value="{{ $question->id }}">
                                                    <input type="hidden" name="exam_setup_id"
                                                        value="{{ $examSetup->id }}">
                                                    @foreach ($question->answerOptions as $key => $answerOption)
                                                        @php
                                                            $alphabet = chr(65 + $key); // Convert index to corresponding alphabet (A, B, C, ...)
                                                            // Check if the answer option matches the submitted answer option for the current question
                                                            $submitted = App\Models\ExamTaken::where(
                                                                'student_id',
                                                                Auth::id(),
                                                            )
                                                                ->where('question_id', $question->id)
                                                                ->exists();

                                                        @endphp
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <!-- Use 'checked' attribute if the answer option is selected -->
                                                                <input class="form-check-input" type="radio"
                                                                    name="answer_option_id"
                                                                    id="answerOption{{ $key }}"
                                                                    value="{{ $answerOption->id }}"
                                                                    {{ $isSelected ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="answerOption{{ $key }}">
                                                                    {{ $alphabet }}.
                                                                    {{ $answerOption->option_text }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div> --}}
                                                <div class="row">
                                                    <input type="hidden" name="question_id"
                                                        value="{{ $question->id }}">
                                                    <input type="hidden" name="exam_setup_id"
                                                        value="{{ $examSetup->id }}">
                                                    @foreach ($question->answerOptions as $key => $answerOption)
                                                        @php
                                                            $alphabet = chr(65 + $key); // Convert index to corresponding alphabet (A, B, C, ...)
                                                            // Check if the answer option matches the submitted answer option for the current question
                                                            $submitted = App\Models\ExamTaken::where(
                                                                'student_id',
                                                                Auth::id(),
                                                            )
                                                                ->where('question_id', $question->id)
                                                                ->where('answer_option_id', $answerOption->id)
                                                                ->exists();
                                                        @endphp
                                                        <div class="col-sm-6">
                                                            <div class="form-check">
                                                                <!-- Use 'checked' attribute if the answer option is submitted -->
                                                                <input class="form-check-input" type="radio"
                                                                    name="answer_option_id"
                                                                    id="answerOption{{ $key }}"
                                                                    value="{{ $answerOption->id }}"
                                                                    {{ $submitted ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="answerOption{{ $key }}">
                                                                    {{ $alphabet }}.
                                                                    {{ $answerOption->option_text }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        @if ($loop->last)
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <button class="btn btn-primary mt-3" value="finish"
                                                                        type="submit">Save</button>

                                                                </div>
                                                                <div class="col-3">
                                                                    <a class="btn btn-primary mt-3"
                                                                        href="{{ route('student.upcomingexam.finish', $examSetup->id) }}">Finish</a>
                                                                </div>

                                                            </div>
                                                        @else
                                                            <button class="btn btn-primary mt-3" type="submit">Save &
                                                                Continue</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2024 <div class="bullet"></div> Developed By <a href="">Mafia's</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/stisla.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!-- Template JS File -->
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    <script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>

    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/modules/moment.min.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admin/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/assets/js/page/forms-advanced-forms.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    {{--
        <script>
    // Disable right-click
window.addEventListener('contextmenu', function (e) {
  e.preventDefault();
});

// Disable text selection
window.addEventListener('selectstart', function (e) {
  e.preventDefault();
});

// Disable copying via keyboard shortcuts
window.addEventListener('keydown', function (e) {
  // Check for Ctrl/Cmd key and C key
  if ((e.ctrlKey || e.metaKey) && e.key === 'c') {
    e.preventDefault();
  }
});
</script>

        -- }}
<


    {{-- <script>
        $(document).ready(function() {
            var examEndTime = localStorage.getItem('examEndTime');

            if (examEndTime) {


                // startTimer(new Date(examEndTime));
                // document.getElementById('current-time2').textContent = datformat;

                startTimer(examEndTime);
            } else {

                var examEndTime = "{{ session('exam_end_time') }}";
                // document.getElementById('current-time2').textContent = examEndTime;

                localStorage.setItem('examEndTime', examEndTime);

                startTimer(examEndTime);
            }

            function startTimer(endTime) {

                function updateTime() {

                    var now = new Date();
                    document.getElementById('current-time1').textContent = now;

                    var timeDifference = Math.max(endTime.getTime() - now.getTime(),
                        0);
                    document.getElementById('current-time2').textContent = endTime.getTime();

                    // $("#current-time").text(timeDifference);
                    document.getElementById('current-time2').textContent = now.getTime();

                    if (timeDifference <= 0) {
                        $("#current-time").text("Exam Ended");
                        localStorage.removeItem('examEndTime');
                        //window.location.href =
                        //  "{{ route('student.upcomingexam.submit', ['examSetupId' => $examSetup->id]) }}";
                    } else {
                        var hours = Math.floor(timeDifference / (1000 * 60 * 60));
                        var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                        // Add leading zeros if necessary
                        hours = hours < 10 ? "0" + hours : hours;
                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;

                        var formattedTime = hours + ":" + minutes + ":" + seconds;

                        // Update the current time display
                        $("#current-time").text(formattedTime);
                    }
                }
                setInterval(updateTime, 1000);
            }
        });
    </script> --}}
    {{-- <script>
        // Retrieve the remaining time from the PHP variable passed to the view
        var remainingTimeInSeconds = {{ $remainingTimeInSeconds }};

        // Function to update the remaining time display
        function updateRemainingTime() {
            // Calculate remaining hours, minutes, and seconds
            var hours = Math.floor(remainingTimeInSeconds / 3600);
            var minutes = Math.floor((remainingTimeInSeconds % 3600) / 60);
            var seconds = remainingTimeInSeconds % 60;

            // Format the remaining time string
            var remainingTimeStr = hours + "h " + minutes + "m " + seconds + "s";

            // Display the remaining time
            document.getElementById('remaining-time').textContent = remainingTimeStr;

            // Update the remaining time every second
            setTimeout(function() {
                remainingTimeInSeconds--;
                updateRemainingTime();
            }, 1000);
        }

        // Call the function to start updating the remaining time
        updateRemainingTime();
    </script> --}}
    {{-- //////////heyyyyyyyyyyyyyyyy --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startButton = document.getElementById('start-button');
            const passwordModal = $('#passwordModal');
            const passwordForm = document.getElementById('passwordForm');
            const errorMessage = document.getElementById('error-message');

            startButton.addEventListener('click', function(event) {
                event.preventDefault();
                passwordModal.modal('show');
            });

            passwordForm.addEventListener('submit', function(event) {
                event.preventDefault();
                errorMessage.style.display = 'none';

                const examPassword = document.getElementById('examPassword').value;
                const examSetupId = "{{ $examSetup->id }}"; // Use Blade to inject the ID

                fetch('{{ route('student.validateExamPassword') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            examSetupId: examSetupId,
                            examPassword: examPassword
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.valid) {
                            window.location.href =
                                "{{ route('student.upcomingexam.create', ['examSetupId' => $examSetup->id]) }}";
                        } else {
                            errorMessage.style.display = 'block';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
    <script>
        // Function to update the remaining time display
        function updateRemainingTime() {
            // Retrieve the remaining time from local storage or set it to the initial value
            var remainingTimeInSeconds = localStorage.getItem('remainingTimeInSeconds') || {{ $remainingTimeInSeconds }};
            document.getElementById('remaining-time1').textContent = remainingTimeInSeconds;

            // Calculate remaining hours, minutes, and seconds
            var hours = Math.floor(remainingTimeInSeconds / 3600);
            var minutes = Math.floor((remainingTimeInSeconds % 3600) / 60);
            var seconds = remainingTimeInSeconds % 60;

            // Format the remaining time string
            var remainingTimeStr = hours + "h " + minutes + "m " + seconds + "s";

            // Display the remaining time
            document.getElementById('remaining-time').textContent = remainingTimeStr;

            // Update the remaining time every second
            var countdownInterval = setInterval(function() {
                remainingTimeInSeconds--;
                localStorage.setItem('remainingTimeInSeconds', remainingTimeInSeconds); // Update local storage
                if (remainingTimeInSeconds <= 0) {
                    clearInterval(countdownInterval); // Stop countdown when time is up
                    window.location.href =
                        "{{ route('student.upcomingexam.submit', ['examSetupId' => $examSetup->id]) }}";
                }
                // Update the remaining time display
                hours = Math.floor(remainingTimeInSeconds / 3600);
                minutes = Math.floor((remainingTimeInSeconds % 3600) / 60);
                seconds = remainingTimeInSeconds % 60;
                remainingTimeStr = hours + "h " + minutes + "m " + seconds + "s";
                document.getElementById('remaining-time').textContent = remainingTimeStr;
            }, 1000);
        }
        // Call the function to start updating the remaining time
        updateRemainingTime();
    </script>
    {{-- //////////////heyyyyyyyyyy --}}
    {{-- <script>
        // Function to calculate remaining time in seconds based on a fixed end time
        function calculateRemainingTime(endTime) {
            var currentTime = new Date().getTime();

            var timeDifference = endTime - currentTime;
            document.getElementById('remaining-time3').textContent = timeDifference;

            return Math.floor(timeDifference / 1000);
        }

        // Function to update the remaining time display
        function updateRemainingTime() {
            // Set the end time (e.g., 1 hour from now)
            var endTime = new Date().getTime() + (1 * 60 * 60 * 1000); // 1 hour from now

            // Retrieve the remaining time from local storage or calculate it
            var remainingTimeInSeconds = localStorage.getItem('remainingTimeInSeconds') || calculateRemainingTime(endTime);
            localStorage.setItem('remainingTimeInSeconds', remainingTimeInSeconds);

            // Update the remaining time every second
            var countdownInterval = setInterval(function() {
                remainingTimeInSeconds--;
                localStorage.setItem('remainingTimeInSeconds', remainingTimeInSeconds); // Update local storage

                // Calculate remaining hours, minutes, and seconds
                var hours = Math.floor(remainingTimeInSeconds / 3600);
                var minutes = Math.floor((remainingTimeInSeconds % 3600) / 60);
                var seconds = remainingTimeInSeconds % 60;

                // Format the remaining time string
                var remainingTimeStr = hours + "h " + minutes + "m " + seconds + "s";

                // Display the remaining time
                document.getElementById('remaining-time1').textContent = remainingTimeInSeconds;
                document.getElementById('remaining-time').textContent = remainingTimeStr;

                // Stop countdown when time is up
                if (remainingTimeInSeconds <= 0) {
                    clearInterval(countdownInterval);
                    localStorage.removeItem('remainingTimeInSeconds'); // Clear local storage
                    // Redirect to the submit page
                    // window.location.href = "{{ route('student.upcomingexam.submit', ['examSetupId' => $examSetup->id]) }}";
                }
            }, 1000);
        }

        // Call the function to start updating the remaining time when the page loads
        window.onload = updateRemainingTime;
    </script> --}}

    {{-- <script>
        // Disable right-click menu
        document.addEventListener('contextmenu', event => event.preventDefault());

        // Prevent opening new tabs or windows
        window.onbeforeunload = function() {
            return "Are you sure you want to leave?";
        };

        // Alert on page reload
        window.addEventListener('beforeunload', function(e) {
            e.preventDefault();
            e.returnValue = '';
        });
    </script> --}}
    {{-- <script>
        var attemptCount = 0;
        // var attemptCount = 0;

        window.addEventListener('blur', function() {
            // Increment the attempt count
            attemptCount++;

            // If the attempt count is less than 3, show a popup explaining why leaving is not allowed
            if (attemptCount < 3) {
                alert("You are not allowed to leave the exam page. Please complete the exam.");
            } else {
                // If the attempt count reaches 3, allow the user to leave by redirecting them to the specified route
                window.location.href = "{{ route('student.upcomingexam.finish', $examSetup->id) }}";
            }
        });
    </script> --}}
    <script>
        toastr.options.progressBar = true;

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>


    @stack('scripts')

</body>

</html>
