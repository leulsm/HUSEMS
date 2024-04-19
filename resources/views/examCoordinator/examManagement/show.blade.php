@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam Setup</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">ExamSetup</div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Exam Title : {{ $examSetup->exam_title }}</h2>
                                <div class="invoice-number">Exam #{{ $examSetup->id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Exam Type:</strong><br>
                                        {{ $examSetup->exam_type }}<br>
                                        Total Mark: <br>
                                        {{ $examSetup->total_mark }}<br>
                                        Pass Mark:<br>
                                        {{ $examSetup->pass_mark }}
                                    </address>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Created By:</strong><br>
                                        Visa ending **** 4242<br>
                                        ujang@maman.com
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Duration Time: </strong><br>
                                        {{ $examSetup->duration_time }}<br><br>
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
                                <a href="{{ route('examManagement.edit', $examSetup->id) }}"
                                    class="btn btn-primary btn-icon icon-left text-white"><i class="fas fa-edit"></i>Edit
                                    Exam
                                    Setup</a>
                            </div>
                            <div class="col-6">
                                <form method="POST" action="{{ route('examManagement.destroy', $examSetup->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this exam setup?')">
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
