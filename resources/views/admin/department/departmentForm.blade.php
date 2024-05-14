@extends('admin.layout.master')

@section('content')
    {{-- <div class="main-content"> --}}
    <section class="section">
        <div class="section-header">
            <h1>Register Department</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Department List</a></div>
            </div>
        </div>
        <div class="section-body">
            <form method="POST" action="{{ route('admin.addDepartment') }}">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6 mx-auto">
                        <div class="card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <div class="form-group">
                                    <label>Department Name</label>
                                    <input type="text" class="form-control" name="department_name">
                                </div>
                                <div class="form-group">
                                    <label>Department Abbreviation</label>
                                    <input type="text" class="form-control" name="department_abbreviation">
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
                                <button type="submit" class="btn btn-success">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </section>
@endsection
