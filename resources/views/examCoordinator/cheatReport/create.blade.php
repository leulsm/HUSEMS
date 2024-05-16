@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Cheat Reports</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Exam Setup</th>
                                <th>Student Name</th>
                                <th>Descrubtion</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cheatReports as $index => $cheatReport)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $cheatReport->examSetup->exam_title }}</td>
                                    <td>{{ $cheatReport->student->first_name }}</td>
                                    <td>{{ $cheatReport->description }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('cheatM.show', $cheatReport->id) }}"
                                                class="btn btn-primary">View
                                                Detail</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
