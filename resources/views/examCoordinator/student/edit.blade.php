@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Student</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('examCoordinator.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a
                        href="{{ route('studentManagement.create', ['examSetupId' => $examSetupId]) }}">Exam
                        Setup</a></div>
                <div class="breadcrumb-item active">Edit Student</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <form method="POST" action="{{ route('studentManagement.update', $student->id) }}">
                    @csrf
                    @method('PUT') <!-- Add this line to specify the HTTP method for update -->

                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $student->first_name }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $student->last_name }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $student->email }}" required
                            disabled>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $student->phone }}" required
                            disabled>
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>

                </form>
            </div>

        </div>
        </div>
    </section>
@endsection
