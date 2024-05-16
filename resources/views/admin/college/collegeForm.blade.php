@extends('admin.layout.master')

@section('content')
{{-- <div class="main-content"> --}}
    <section class="section">
        <div class="section-header">
            <h1>College Registration</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('collegeList') }}" class="btn btn-info">College List</a>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('storeCollege') }}">
            @csrf
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6 mx-auto">
                        <!-- Adjust the column classes as per your desired width -->
                        <div class="card">
                            <form>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>College Name</label>
                                        <input type="text" name="college_name" class="form-control"
                                            required="">
                                        <div class="valid-feedback">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>College Abbreviation</label>
                                        <input type="text" name="college_abbrivation" class="form-control" required="">
                                        <div class="valid-feedback">

                                        </div>
                                    </div>

                                    <div class="card-footer text-center">
                                    <button class="btn btn-primary">Register</button>
                                </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
    </section>
    @endsection
