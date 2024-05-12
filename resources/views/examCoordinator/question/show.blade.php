@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam Setup</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('examCoordinator.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('questionManagement.index') }}">Exam Setup</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Question : {{ $question->question_text }}</h2>
                                <div class="invoice-number">Question #{{ $question->id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Question Type:</strong><br>
                                        {{ $question->question_type }}<br>
                                        <strong>Question Mark:</strong><br>
                                        {{ $question->mark }}<br>
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
                                <a href="{{ route('questionManagement.edit', $question->id) }}"
                                    class="btn btn-primary btn-icon icon-left text-white"><i class="fas fa-edit"></i>Edit
                                    Question</a>
                            </div>
                            <div class="col-6">
                                <form method="POST" action="{{ route('questionManagement.destroy', $question->id) }}"
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
