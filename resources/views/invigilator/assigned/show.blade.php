@extends('invigilator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam Setup</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('invigilator.assigned.index') }}">Assigned Exam</a>
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
                            <div class="invoice-title">
                                <h2>Exam Password : {{ $examprepass->exam_password }}</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Duration:</strong><br>
                                        {{ $examSetup->duration_time }}
                                        <br>

                                    </address>
                                </div>

                                <div class="col-md-6 text-md-left">
                                    <address>
                                        <strong>Remaining Time: </strong><br>
                                        <span id="remaining-time">{{ $remainingTime }}</span><br><br>
                                        {{-- <button id="start-button" type="button" class="btn btn-primary d-none">Start
                                            Exam</button> --}}


                                        {{-- </div> --}}
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
                                            remainingTimeSpan.textContent = 'Exam Started';
                                            // window.location.href =
                                            //     "{{ route('invigilator.updatestatus', ['invigilatorId' => $invigilator->id, 'examSetup' => $examSetup]) }}";
                                            // document.getElementById('start-button').classList.remove('d-none');

                                            // document.querySelector('.start-link').parentNode.classList.remove('d-none');
                                            var invigilatorId = "{{ $invigilator->id }}"; // Assuming $invigilator is passed to the view
                                            var csrfToken = "{{ csrf_token() }}";

                                            fetch('{{ route('invigilator.updatestatus') }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': csrfToken
                                                    },
                                                    body: JSON.stringify({
                                                        invigilatorId: invigilatorId
                                                    })
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.status === 'success') {
                                                        alert("Exam Started");
                                                    } else {
                                                        alert("Failed to update invigilator status.");

                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });
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

                                    function updateInvigilatorStatus() {
                                        var invigilatorId = "{{ $invigilator->id }}"; // Assuming $invigilator is passed to the view
                                        var csrfToken = "{{ csrf_token() }}";

                                        fetch('{{ route('invigilator.updatestatus') }}', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': csrfToken
                                                },
                                                body: JSON.stringify({
                                                    invigilatorId: invigilatorId
                                                })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.status === 'success') {
                                                    alert("Exam Started");
                                                } else {
                                                    alert("Failed to update invigilator status.");

                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                            });
                                    }
                                </script>

                            </div>
                        </div>


                    </div>
                    <hr>

                </div>
            </div>

    </section>
@endsection