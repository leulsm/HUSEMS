@extends('invigilator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Cheat Report</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('cheatManagement.index') }}">Dashboard</a></div>

                <div class="breadcrumb-item active">Edit Cheat Report</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">

                <form method="POST" action="{{ route('cheatManagement.update', $cheatReport->id) }}">
                    @csrf
                    @method('PUT') <!-- Add this line to specify the HTTP method for update -->

                    <div class="form-group">
                        <label for="student_id">Select Student</label>
                        <select class="form-control" name="student_id" id="student_id" required>
                            <option value="">Select Student</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ $student->id == $cheatReport->student_id ? 'selected' : '' }}>
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" required>{{ $cheatReport->description }}</textarea>
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>

                </form>
            </div>

        </div>
        </div>
    </section>
@endsection
