@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <form method="POST" action="{{ route('examManagement.store') }}">
                        @csrf
                        {{-- <div class="card-header">
                            <h4>Exam Setup</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Exam Title</label>
                                <input type="text" class="form-control" required="">
                            </div>
                            <div class="form-group">
                                <label>Exam Type</label>
                                <select class="form-control selectric">
                                    <option>Exit Exam</option>
                                    <option>Holistic Exam</option>
                                    <option>Low Exam</option>
                                    <option>Mock Exam</option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Exam Date</label>
                                <input type="text" class="form-control datepicker">
                            </div>
                            <div class="form-group">
                                <label>Exam Time</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control timepicker">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Total Mark</label>
                                <input type="text" class="form-control" name="total_mark" required>
                            </div>
                            <div class="form-group">
                                <label>Pass Mark</label>
                                <input type="number" class="form-control" name="pass_mark" required>
                            </div> --}}


                        <div class="form-group">
                            <label>Exam Title</label>
                            <input type="text" class="form-control" name="exam_title" required>
                        </div>
                        <div class="form-group">
                            <label>Exam Type</label>
                            <select class="form-control selectric" name="exam_type">
                                <option value="exit">Exit Exam</option>
                                <option value="holistic">Holistic Exam</option>
                                <option value="low">Low Exam</option>
                                <option value="mock">Mock Exam</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Exam Date</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="form-group">
                            <label>Exam Time</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                                <input type="time" class="form-control" name="time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total Mark</label>
                            <input type="number" class="form-control" name="total_mark" required>
                        </div>
                        <div class="form-group">
                            <label>Pass Mark</label>
                            <input type="number" class="form-control" name="pass_mark" required>
                        </div>


                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
                </form>
            </div>

        </div>

        </div>


    </section>
@endsection
