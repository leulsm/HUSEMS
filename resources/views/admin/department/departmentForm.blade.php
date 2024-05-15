@extends('admin.layout.master')

@section('content')
<section class="section">
        <div class="section-header">
            <h1>Department Registration</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="btn btn-info">Department List</a>
                </div>
            </div>
        </div>
        <form method="post" action="{{ route('admin.addDepartment') }}">
            @csrf
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6 mx-auto">
                        <!-- Adjust the column classes as per your desired width -->
                        <div class="card">
<<<<<<< HEAD
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="form-group">
                                    <label>Department Name</label>
                                    <input type="text" class="form-control" name="department_name">
=======
                            <form>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Department Name</label>
                                        <input type="text" name="department_name" class="form-control"
                                            required="">
                                        <div class="valid-feedback">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Department_abbrivation</label>
                                        <input type="text" name="department_abbreviation" class="form-control" required="">
                                        <div class="valid-feedback">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Select College</label>
                                        <select class="form-control" name="college_name">
                                            <option value="">Select College</option>
                                            @foreach ($college as $college)
                                                <option value="{{ $college->college_name }}">{{ $college->college_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="card-footer text-center">
                                    <button class="btn btn-primary">Register</button>
>>>>>>> 52ba533c9317b38ed06b1492d66ab4b58a4a15aa
                                </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
    </section>
@endsection
