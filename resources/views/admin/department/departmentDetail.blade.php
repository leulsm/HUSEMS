@extends('admin.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Department</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Department Name: {{ $department->department_name }}</h2>
                            <div class="invoice-number">Department #{{ $department->id }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Department Abbreviation:</strong><br>
                                    {{ $department->department_abbrivation }}<br>
                                    <strong>Number of Department:</strong><br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Created By:</strong><br>
                                    leulsolm7@gmail.com<br>
                                </address>
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
                            <a href="{{ route('department.edit', $department->id) }}"
                                class="btn btn-primary btn-icon icon-left text-white"><i class="fas fa-edit"></i>Edit
                                Department</a>
                        </div>
                        <div class="col-6">
                            <form method="POST" action="{{ route('department.delete', $department->id) }}"
                                onsubmit="return confirm('Are you sure you want to delete this department?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-icon">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
