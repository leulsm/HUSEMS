@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Student</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <form method="POST" action="{{ route('studentManagement.store', ['exam_setup_id' => $examSetupId]) }}">
                    @csrf
                    <input type="hidden" name="exam_setup_id" value="{{ $examSetupId }}">

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>

                    <button class="btn btn-primary" type="submit">Add</button>

                </form>
                <hr>
                <form method="POST" action="{{ route('examCoordinator.student.storebulk') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Other form fields -->

                    {{-- <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bulk Student Data
                            Upload</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="file" name="bulk_data" accept=".csv" />
                            <small class="form-text text-muted">Upload a XML,CSV file containing student data.</small>
                        </div>
                    </div> --}}
                    <input type="text" name="exam_setup_id" value="{{ $examSetupId }}" hidden>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bulk Student Data
                            Upload</label>
                        <div class="col-sm-12 col-md-7">
                            {{-- <div id="image-preview" class="image-preview"> --}}
                            <input type="file" name="bulk_data" accept=".csv" />
                            <small class="form-text text-muted">Upload a XML,CSV file containing student data.</small>
                            {{-- </div> --}}
                        </div>
                        {{-- <div class="col-sm-12 col-md-7">
                            <small class="form-text text-muted">Upload a XML,CSV file containing student data.</small>

                        </div> --}}

                    </div>

                    <!-- Other form fields -->

                    <div class="form-group row mb-4">
                        <div class="col-sm-12 col-md-7 offset-md-3">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6 col-lg-6">

                Students List
                @if ($students->isEmpty())
                    <div class="card">
                        <div class="card-header ">
                            <h4>Empty Student Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                    <i class="fas fa-question"></i>
                                </div>
                                <h2>We couldn't find any student data</h2>
                                <p class="lead">
                                    Register at least 1 Student.
                                </p>

                            </div>
                        </div>
                    </div>
                @else
                    <div class="card ">
                        <div class="card-body" id="top-5-scroll">

                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($students as $student)
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="media-title">{{ $student->first_name }} {{ $student->last_name }}
                                            </div>
                                            <div class="mt-1">
                                                {{ $student->email }}
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <a href="{{ route('studentManagement.edit', $student->id) }}"
                                                class="btn btn-primary px2"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('studentManagement.show', $student->id) }}"
                                                class="btn btn-success"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- <div class="card">
                    <div class="card-body" id="top-5-scroll">
                        @if ($students->isEmpty())
                            <div class="row">
                                <div class="col-12 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Empty Data</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="empty-state" data-height="400">
                                                <div class="empty-state-icon">
                                                    <i class="fas fa-question"></i>
                                                </div>
                                                <h2>We couldn't find any data</h2>
                                                <p class="lead">
                                                    Sorry we can't find any data, to get rid of this message, make at least
                                                    1
                                                    entry.
                                                </p>
                                                <a href="#" class="btn btn-primary mt-4">Create new One</a>
                                                <a href="#" class="mt-4 bb">Need Help?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($students as $student)
                                    <li class="media">
                                        <div class="media-body">
                                            <div class="media-title">{{ $student->first_name }} {{ $student->last_name }}
                                            </div>
                                            <div class="mt-1">
                                                {{ $student->email }}
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <a href="{{ route('studentManagement.edit', $student->id) }}"
                                                class="btn btn-primary px2"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('studentManagement.show', $student->id) }}"
                                                class="btn btn-success"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div> --}}

            </div>
        </div>
        </div>
    </section>
@endsection
