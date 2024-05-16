@extends('admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit ExamCoordinator</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            </div>
        </div>
        <div class="section-body">
            <form method="POST" action="{{ route('examCoordinator.update', $examCoordinator->id) }}">
                @csrf
                @method('PUT')

                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <label for="first_name">ExamCoordinator First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{ $examCoordinator->first_name }}" required>
                                    <div class="invoice-number">ExamCoordinator #{{ $examCoordinator->id }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="last_name">ExamCoordinator Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                               value="{{ $examCoordinator->last_name }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="email">ExamCoordinator Email</label>
                                        <input type="email" class="form-control" name="email"
                                               value="{{ $examCoordinator->email }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="phone">ExamCoordinator Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                               value="{{ $examCoordinator->phone }}" required>
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
                                        <i class="fas fa-edit"></i> Update ExamCoordinator
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
