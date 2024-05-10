@extends('student.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $examSetup->exam_title }} Result</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('student.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('student.takenexam.index') }}">Taken Exams</a></div>
                <div class="breadcrumb-item">Exam
                    Result</div>
            </div>
        </div>


        <div class="section-body">
            <h2 class="section-title">Score Analysis</h2>
            <p class="section-lead">Check your total mark you scored for this specific exam.</p>
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Exam Detial</h4>
                            <div class="card-header-action">
                                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary" href="#"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="collapse " id="mycard-collapse">
                            <div class="card-body">
                                Exam Type: {{ $examSetup->exam_type }}
                                <div class="div">
                                    Exam : {{ $examSetup->exam_title }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="div">
                                    Total Mark: {{ $examSetup->total_mark }}
                                </div>
                                <div class="div">
                                    Pass Mark: {{ $examSetup->pass_mark }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing pricing-highlight">
                        <div class="pricing-title">
                            Your Score
                        </div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>{{ $totalScore }}/{{ $examSetup->total_mark }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing pricing-highlight">
                        <div class="pricing-title">
                            Persontage Score
                        </div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>{{ $percentage }}%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing pricing-highlight">
                        <div class="pricing-title">
                            Status
                        </div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>{{ $status }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
