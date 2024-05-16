@extends('invigilator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Cheat Report</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('cheatManagement.index') }}">Cheat Report</a>
                </div>
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
                                </div>

                            </div>

                            @if ($examSetup->schedule)
                                <a href="{{ route('cheatManagement.create', ['examSetupId' => $examSetup->id]) }}"
                                    class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="GET" class="dropzone" id="mydropzone">
                                                <div class="mx-auto my-3 add-question" id="startButton">Report Cheating
                                                </div>
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
                        <div class="card-header ">
                            <h4>Empty Assigned data</h4>
                        </div>
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>We couldn't find any Assigned Exam Setup data</h2>
                                <p class="lead">
                                    It will appear here once their is Active Exam.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    </section>
@endsection
