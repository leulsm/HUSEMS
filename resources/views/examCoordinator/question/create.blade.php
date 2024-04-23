@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Question</h1>
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

        </div>

        </div>
    </section>
@endsection
