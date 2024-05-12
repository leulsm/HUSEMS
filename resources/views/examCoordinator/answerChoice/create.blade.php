@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Questions</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('examCoordinator.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('answerChoiceManagement.index') }}">Exam Setups</a>
                </div>
                <div class="breadcrumb-item">Add Answer</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Exam Setup Details</h4>
                        <div class="card-header-action">
                            <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary" href="#"><i
                                    class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="collapse " id="mycard-collapse">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4"> Exam Title: {{ $examSetup->exam_title }}</div>
                                <div class="col-4"> Exam Title: {{ $examSetup->exam_type }}</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-4"> Total Mark: {{ $examSetup->total_mark }}</div>
                                <div class="col-4"> Pass Mark: {{ $examSetup->pass_mark }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>




        <div class="row mt-5">
            <div class="col-12 col-sm-7 col-lg-7">

                <div class="row">

                    <div class="col-12 col-sm-12 col-md-5">
                        <h3>Questions</h3>

                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">


                            @foreach ($questions as $key => $question)
                                <li class="nav-item">
                                    <a class="nav-link{{ $question->id == session('active_question') ? ' active' : '' }}"
                                        id="question-tab{{ $key }}" data-toggle="tab"
                                        href="#question{{ $key }}" role="tab"
                                        aria-controls="question{{ $key }}"
                                        aria-selected="{{ $question->id == session('active_question') ? 'true' : 'false' }}">Q{{ $key + 1 }}.
                                        {{ $question->question_text }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- <div class="pricing-item-icon bg-danger text-white"><i class="fas fa-times"></i></div> --}}


                    <div class="col-12 col-sm-12 col-md-7">
                        <h3>Add Options</h3>

                        <div class="tab-content no-padding" id="myTab2Content">
                            @foreach ($questions as $key => $question)
                                <div class="tab-pane fade{{ $question->id == session('active_question') ? ' show active' : '' }}"
                                    id="question{{ $key }}" role="tabpanel"
                                    aria-labelledby="question-tab{{ $key }}">
                                    <p>Question {{ $key + 1 }}: {{ $question->question_text }}</p>
                                    <p>Options:</p>

                                    <div class="row">
                                        @foreach ($question->answerOptions as $key => $answerOption)
                                            @php
                                                $alphabet = chr(65 + $key); // Convert index to corresponding alphabet (A, B, C, ...)
                                            @endphp
                                            <div class="col-sm-6">
                                                {{-- <div class="d-flex">
                                                    <div class="mr-2">{{ $alphabet }}.</div>
                                                    <div>{{ $answerOption->option_text }}</div>
                                                    <div style="background: rgb(111, 230, 111); padding:5cm;"
                                                        class="pricing-item-icon">
                                                        <i class="fas fa-check"></i>
                                                    </div>

                                                </div> --}}
                                                {{-- <div class="d-flex text-center">
                                                    <div class="mr-2">{{ $alphabet }}.</div>
                                                    <div>{{ $answerOption->option_text }}</div>
                                                    <div class="ml-2"
                                                        style="width: 20px; height: 20px; border-radius: 50%; background-color: rgb(111, 230, 111); display: flex; justify-content: center; align-items: center;">
                                                        <i class=" fas fa-check"></i>
                                                    </div>
                                                </div> --}}
                                                <div class="d-flex">
                                                    <div class="mr-2">{{ $alphabet }}.</div>
                                                    <div>{{ $answerOption->option_text }}</div>
                                                    @if ($answerOption->is_correct)
                                                        <div class="ml-2"
                                                            style="width: 20px; height: 20px; border-radius: 50%; background-color: rgb(111, 230, 111); display: flex; justify-content: center; align-items: center;">
                                                            <i class="fas fa-check text-white"></i>
                                                        </div>
                                                    @else
                                                        <div class="ml-2"
                                                            style="width: 20px; height: 20px; border-radius: 50%; background-color: rgb(230, 111, 111); display: flex; justify-content: center; align-items: center;">
                                                            <i class="fas fa-times text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            {{-- <div class="pricing"> --}}

                                            {{-- <div class="pricing-padding"> --}}

                                            {{-- <div class="pricing-details">
                                                    <div class="pricing-item">
                                                        </div>
                                                        <div class="pricing-item-label">1 user agent</div>
                                                    </div>

                                                </div> --}}
                                            {{-- </div> --}}

                                            {{-- </div> --}}
                                        @endforeach
                                    </div>
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
