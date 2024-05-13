@extends('admin.layout.master')

@section('content')
    {{-- <div class="main-content"> --}}
    <section class="section">
        <div class="section-header">
            <h1>Exam Coordinator Registration</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('examCoordinatorList') }}" class="btn btn-info">College List</a>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('storeCoordinator') }}">
            @csrf
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6 mx-auto">
                        <!-- Adjust the column classes as per your desired width -->
                        <div class="card">
                            <form>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                            required="">
                                        <div class="valid-feedback">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control" required="">
                                        <div class="valid-feedback">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            required="">

                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Register Coordinator</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
    </section>
@endsection
