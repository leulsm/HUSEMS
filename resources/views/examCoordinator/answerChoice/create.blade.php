@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Questions</h1>
        </div>
        <h2>Exam Setup Details</h2>
        <div class="row">
            <div class="col-md-4">
                <p>Exam Title: {{ $examSetup->exam_title }}</p>
            </div>
            <div class="col-md-4">
                <p>Exam Type: {{ $examSetup->exam_type }}</p>
            </div>
            <div class="col-md-4">
                <p>Exam Total Mark: {{ $examSetup->total_mark }}</p>
            </div>
        </div>



        <h2>Questions</h2>

        <div class="row">
            <div class="col-12 col-sm-7 col-lg-7">

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4">
                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                            @foreach ($questions as $key => $question)
                                <li class="nav-item">
                                    <a class="nav-link{{ $key === 0 ? ' active' : '' }}"
                                        id="question-tab{{ $key }}" data-toggle="tab"
                                        href="#question{{ $key }}" role="tab"
                                        aria-controls="question{{ $key }}"
                                        aria-selected="{{ $key === 0 ? 'true' : 'false' }}">
                                        {{ $question->question_text }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <div class="tab-content no-padding" id="myTab2Content">
                            @foreach ($questions as $key => $question)
                                <div class="tab-pane fade{{ $key === 0 ? ' show active' : '' }}"
                                    id="question{{ $key }}" role="tabpanel"
                                    aria-labelledby="question-tab{{ $key }}">
                                    <p>{{ $question->question_text }}</p>
                                    <p>{{ $question->id }}</p>
                                    <ul>
                                        @foreach ($question->answerOptions as $answerOption)
                                            <li>{{ $answerOption->option_text }}</li>
                                        @endforeach
                                    </ul>

                                    <div class="row">
                                        <form method="POST" action="{{ route('answerChoiceManagement.store') }}">
                                            @csrf
                                            <input type="hidden" name="question_id" value="{{ $question->id }}">

                                            <div class="form-group mr-5">
                                                <label>Answer Title</label>
                                                <input type="text" class="form-control" name="option_text" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="d-block">Is Correct</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_correct"
                                                        id="exampleRadios1" value="1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_correct"
                                                        id="exampleRadios2" value="0">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Add Answer</button>


                                    </form>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
