@extends('admin.layout.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>College List</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <div class="d-flex justify-content-end mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-md">
                        <tr>
                            <th>#</th>
                            <th>College Name</th>
                            <th>College Abbreviation</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($list as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->college_name }}</td>
                                <td>{{ $item->college_abbrivation }}</td>
                                <td>
                                    <a href="{{ route('college.detail', $item->id) }}" class="btn btn-primary">View Detail</a>
                                    <a href="{{route('college.edit', $item->id)}}" class="btn btn-success">Update</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
