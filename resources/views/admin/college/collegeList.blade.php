@extends('admin.layout.master')

@section('content')
    <div class="main-content">

                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-md">
                                            <table class="table table-bordered table-md">
                        <tr>
                            <th>#</th>
                            <th>College Name</th>
                            <th>College Abbreviation</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($list as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->college_name }}</td>
                            <td>{{ $item->college_abbrivation }}</td>
                            <td>
                            <a href="#" class="btn btn-primary">View Detail</a>
                            <a href="#" class="btn btn-success">Update</a>
                            <a href="#" class="btn btn-info">Add Department</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </table>

                        <a href="{{ route('admin.dashboard') }}"><button>HOME</button></a>
                    </div>
                  </div>
                </div>
              </div>
              </div>


@endsection
