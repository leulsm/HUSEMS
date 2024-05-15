@extends('admin.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit College</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        </div>
    </div>
    <div class="section-body">
        <form method="POST" action="{{ route('college.update', $college->id) }}">
            @csrf
            @method('PUT')

            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <label for="college_name">College Name</label>
                                <input type="text" class="form-control" name="college_name" value="{{ $college->college_name }}" required>
                                <div class="invoice-number">College #{{ $college->id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="college_abbrivation">College Abbreviation</label>
                                    <input type="text" class="form-control" name="college_abbrivation"
                                        value="{{ $college->college_abbrivation }}" required>
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
                                    <i class="fas fa-edit"></i> Update College
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