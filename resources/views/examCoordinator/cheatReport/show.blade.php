@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Cheat Report</h1>
            <div class="section-header-breadcrumb">

            </div>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Exam : {{ $cheatreport->examSetup->exam_title }}</h2>
                                <div class="invoice-number">Exam #{{ $cheatreport->examSetup->id }}</div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Student Name:</strong><br>
                                        {{ $cheatreport->student->first_name }}<br>
                                        Email: <br>
                                        {{ $cheatreport->student->email }}<br>

                                    </address>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Descrubtion:</strong><br>
                                            {{ $cheatreport->description }}<br>

                                        </address>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                    <hr>
                    <div class="invoice-title">
                        <h2>Take Action </h2>
                    </div>

                    <div class="col-6">
                        <form method="POST" action="{{ route('cheatM.store', $cheatreport->id) }}"
                            onsubmit="return confirm('Are you sure you want to suspend student exam?')">
                            @csrf

                            <button type="submit" class="btn btn-danger btn-icon">
                                Suspend user
                            </button>
                        </form>
                    </div>

                    {{-- <div class="text-md-right">
                        <div class="float-lg-left mb-lg-0 mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('cheatManagement.edit', $cheatreport->id) }}"
                                        class="btn btn-primary btn-icon icon-left text-white"><i
                                            class="fas fa-edit"></i>Edit
                                        Cheat Report</a>
                                </div>
                                <div class="col-6">
                                    <form method="POST" action="{{ route('cheatManagement.destroy', $cheatreport->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this Cheat Report?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>



                        </div>
                    </div> --}}


                </div>
            </div>

    </section>
@endsection
