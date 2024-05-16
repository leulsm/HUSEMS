@extends('admin.layout.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Department List</h1>
        <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('departmentForm') }}">Add Department</a></div>
                <div class="breadcrumb-item active">DepartmentList</div>
        </div>
    </div>

    <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <div class="d-flex justify-content-end mb-3">
                <form method="GET" action="{{ route('department.search') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-md">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>Department Abbreviation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->department_name }}</td>
                            <td>{{ $item->department_abbrivation }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('department.detail', $item->id) }}" class="btn btn-primary">View Detail</a>
                                    <a href="{{ route('department.edit', $item->id) }}" class="btn btn-success">Update</a>
                                    <form method="POST" action="{{ route('department.delete',$item->id)}}"
                                        onsubmit="return confirm('Are you sure you want to delete this Department?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon ml-2">
                                            Delete
                                        </button>
                                    </form>
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



<script>
    $(document).ready(function() {
        // Define the table and search input elements
        var table = $('#college-table');
        var searchInput = $('#search-input');

        // Perform search when the search button is clicked
        $('#search-button').on('click', function() {
            var searchValue = searchInput.val().toLowerCase();

            // Filter the table rows based on the search value
            table.find('tbody tr').each(function() {
                var row = $(this);
                var collegeName = row.find('td:nth-child(2)').text().toLowerCase();
                var collegeAbbreviation = row.find('td:nth-child(3)').text().toLowerCase();

                if (collegeName.includes(searchValue) || collegeAbbreviation.includes(searchValue)) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        });
    });
</script>

@endsection


