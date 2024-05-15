@extends('admin.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Department</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        </div>
    </div>
    <div class="section-body">
        <form method="POST" action="{{ route('department.update', $department->id) }}">
            @csrf
            @method('PUT')

            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <label for="department_name">Department Name</label>
                                <input type="text" class="form-control" name="department_name" value="{{ $department->department_name }}" required>
                                <div class="invoice-number">Department #{{ $department->id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="department_abbrivation">Department Abbreviation</label>
                                    <input type="text" class="form-control" name="department_abbrivation"
                                        value="{{ $department->department_abbrivation }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-icon icon-left text-white">
                                    <i class="fas fa-edit"></i> Update Department
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
