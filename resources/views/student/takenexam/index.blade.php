@extends('student.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Taken Exam</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('student.takenexam.index') }}">Taken Exam</a></div>
                {{-- <div class="breadcrumb-item">Exam Taken</div> --}}
            </div>
        </div>

        <div class="row">
            @if (count($examSetups) > 0)
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

                                    <a href="{{ route('student.takenexam.show', $examSetup->id) }}" class="">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-center my-3 add-question">View Detail</div>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header ">
                            <h4>Empty Taken data</h4>
                        </div>
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>We couldn't find any Taken Exam Setup data</h2>
                                <p class="lead">
                                    It will appear here once you take an exam.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
