@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam Setup</h1>
        </div>

        <div class="row">
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
                                <a href="{{ route('studentManagement.create', ['examSetupId' => $examSetup->id]) }}"
                                    class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="GET" class="dropzone" id="mydropzone">
                                                <div class="mx-auto my-3 add-question">Add Students</div>
                                            </form>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
