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

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
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

<body>
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
                                                <div class="row">
                                                    <input type="hidden" name="question_id"
                                                        value="{{ $question->id }}">
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
                                                </div>
                                                {{-- <div class="row">
                                                    <div class="col-4">
                                                        <button class="btn btn-primary mt-3" type="submit">Save &
                                                            Continue</button>
                                                    </div>
                                                </div> --}}

                                                <div class="row">
                                                    <div class="col-4">
                                                        @if ($loop->last)
                                                            {{-- Check if it's the last question --}}
                                                            <a class="btn btn-primary mt-3"
                                                                href="{{ route('student.takenexam.index') }}">Finish</a>
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
                    Copyright &copy; 2024 <div class="bullet"></div> Design By <a href="">Mafia's</a>
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
    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/css/toastr.min.css') }}"> --}}

    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/modules/moment.min.js') }}"></script>

    <!-- JS Libraies -->
    {{-- <script src="{{ asset('admin/assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script> --}}
    <script src="{{ asset('admin/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    {{-- <script src="{{ asset('admin/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script> --}}
    <script src="{{ asset('admin/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script> --}}

    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/assets/js/page/forms-advanced-forms.js') }}"></script>

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
