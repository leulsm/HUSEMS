@extends('invigilator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Cheat Report</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <form method="POST" action="{{ route('cheatManagement.store', ['exam_setup_id' => $examSetupId]) }}">
                    @csrf
                    <input type="hidden" name="exam_setup_id" value="{{ $examSetupId }}">
                    {{-- <input type="hidden" name="student_id" value="{{ $examSetupId }}"> --}}
                    <input type="hidden" name="invigilator_id" value="{{ $invigilator->id }}">
                    <div class="form-group">
                        <label for="student_id">Select Student</label>
                        <select class="form-control" name="student_id" id="student_id" required>
                            <option value="">Select Student</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Report</button>
                </form>
                <hr>

            </div>
            <div class="col-12 col-md-6 col-lg-6">

                Recent Cheat Report
                @if ($cheatReports->isEmpty())
                    <div class="card">
                        <div class="card-header ">
                            <h4>Empty Cheat Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>We couldn't find any cheat report data</h2>
                                <p class="lead">
                                    No Cheat report Yet.
                                </p>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="card ">
                        <div class="card-body" id="top-5-scroll">

                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($cheatReports as $cheatReport)
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="media-title">{{ $cheatReport->student->first_name }}
                                                {{ $cheatReport->student->last_name }}
                                            </div>
                                            <div class="mt-1">
                                                {{ $cheatReport->student->email }}
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <a href="{{ route('cheatManagement.edit', $cheatReport->id) }}"
                                                class="btn btn-primary px2"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('cheatManagement.show', $cheatReport->id) }}"
                                                class="btn btn-success"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        </div>
    </section>
@endsection
