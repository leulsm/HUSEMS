@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Question</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <form method="POST" action="{{ route('questionManagement.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Question Title</label>
                        <input type="text" class="form-control" name="exam_title" required>
                    </div>
                    <div class="form-group">
                        <label>Question Mark</label>
                        <input type="number" class="form-control" name="total_mark" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>

                </form>
            </div>

        </div>

        </div>
    </section>
@endsection
