@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Student</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <form method="POST" action="{{ route('studentManagement.store', ['exam_setup_id' => $examSetupId]) }}">
                    @csrf
                    <input type="hidden" name="exam_setup_id" value="{{ $examSetupId }}">

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>

                    <button class="btn btn-primary" type="submit">Add</button>

                </form>
            </div>
            <div class="col-12 col-md-6 col-lg-6">

                Students List

                <div class="card ">
                    <div class="card-body" id="top-5-scroll">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($students as $student)
                                <li class="media">
                                    <div class="media-body">
                                        <div class="media-title">{{ $student->first_name }} {{ $student->last_name }}</div>
                                        <div class="mt-1">
                                            {{ $student->email }}
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <a href="" class="btn btn-primary px2"><i class="fas fa-edit"></i></a>
                                        <a href="" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
