@extends('admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam Setup Schedule</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('examList') }}">Exam List</a></div>
                <div class="breadcrumb-item active">Exam Setup Schedule</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <div class="form-group">
                    <label>Exam Title</label>
                    <input type="text" class="form-control" value="{{ isset($examSetup) ? $examSetup->exam_title : '' }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Exam Type</label>
                    <input type="text" class="form-control" value="{{ isset($examSetup) ? $examSetup->exam_type : '' }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Exam Duration Time</label>
                    <input type="time" class="form-control"
                        value="{{ isset($examSetup) ? $examSetup->exam_duration : '' }}" readonly>
                </div>
                <div class="form-group">
                    <label>Total Mark</label>
                    <input type="number" class="form-control" value="{{ isset($examSetup) ? $examSetup->total_mark : '' }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Pass Mark</label>
                    <input type="number" class="form-control" value="{{ isset($examSetup) ? $examSetup->pass_mark : '' }}"
                        readonly>
                </div>



                <form method="POST" action="{{ route('setSchedule', ['exam_setup_id' => $examSetupId]) }}">
                    @csrf

                    <input type="hidden" name="exam_setup_id" value="{{ $examSetupId }}">
                    <!-- <div class="form-group">
                          <label>Starting Date</label>
                          <input type="text" class="form-control datepicker"name="starting_date">
                    </div>

                    <div class="form-group">
                          <label>Ending Date</label>
                          <input type="text" class="form-control datepicker"name ="ending_date">
                    </div> -->


                    <div class="form-group">
                        <label>Select Starting Date</label>
                        <input type="text" class="form-control datetimepicker " name="starting_date">
                    </div>
                    <div class="form-group">
                        <label>Date Time Picker</label>
                        <input type="text" class="form-control datetimepicker " name="ending_date">
                    </div>



                    <button type="submit" class="btn btn-primary">Save Schedule</button>


                </form>
            </div>
        </div>







    </section>
@endsection
