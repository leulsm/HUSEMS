@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Question</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('examCoordinator.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('questionManagement.index') }}">Exam Setup</a></div>
                <div class="breadcrumb-item">Add Question</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <form method="POST" action="{{ route('questionManagement.store', ['exam_setup_id' => $examSetupId]) }}">
                    @csrf
                    <input type="hidden" name="exam_setup_id" value="{{ $examSetupId }}">
                    <div class="form-group">
                        <label>Question Type</label>
                        <select class="form-control selectric" name="question_type">
                            <option value="choice">Choice</option>
                            <option value="truefalse">True/False</option>
                            <option value="match">Match</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Question Title</label>
                        <input type="text" class="form-control" name="question_text" required>
                    </div>
                    <div class="form-group">
                        <label>Question Mark</label>
                        <input type="number" class="form-control" name="mark" min="1" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>

            <div class="col-12 col-md-6 col-lg-6">
                Recent Questions
                @if ($questions->isEmpty())
                    <div class="card">
                        <div class="card-header ">
                            <h4>Empty Question Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>We couldn't find any question data</h2>
                                <p class="lead">
                                    Register at least 1 Question.
                                </p>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="card ">
                        <div class="card-body" id="top-5-scroll">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($questions as $index => $question)
                                    <li class="media">
                                        {{-- <img class="mr-3 rounded" width="55"
                                        src="{{ asset('admin/assets/img/products/product-3-50.png') }}" alt="product"> --}}
                                        <div class="media-body">
                                            <div class="media-title">Q{{ $index + 1 }}. {{ $question->question_text }}
                                            </div>
                                            <div class="mt-1">

                                                0 Answer Options
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <a href="{{ route('questionManagement.edit', $question->id) }}"
                                                class="btn btn-primary px2"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('questionManagement.show', $question->id) }}"
                                                class="btn btn-success"><i class="fas fa-eye"></i></a>
                                        </div>

                                        <a
                                            href="{{ route('answerChoiceManagement.create', ['examSetupId' => $examSetupId, 'active_question' => $question->id]) }}">
                                            <form action="GET" class="dropzone1" id="mydropzone">
                                                <div class=" add-question"><i class="fas fa-plus px-2"></i></div>
                                                <p class="px-2">Answer Options</p>
                                            </form>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

        </div>

        </div>
    </section>
@endsection
