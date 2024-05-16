@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Student</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('examCoordinator.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a
                        href="{{ route('invigilatorManagement.create', ['examSetupId' => $examSetupId]) }}">Exam
                        Setup</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invigilator Name : {{ $invigilator->first_name }} {{ $invigilator->last_name }}</h2>
                                <div class="invoice-number">Invigilator #{{ $invigilator->id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Email:</strong><br>
                                        {{ $invigilator->email }}<br>
                                        <strong>Phone:</strong><br>
                                        {{ $invigilator->phone }}<br>
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
                                <a href="{{ route('invigilatorManagement.edit', $invigilator->id) }}"
                                    class="btn btn-primary btn-icon icon-left text-white"><i class="fas fa-edit"></i>Edit
                                    Student</a>
                            </div>
                            <div class="col-6">
                                <form method="POST" action="{{ route('invigilatorManagement.destroy', $invigilator->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this Question?')">
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
