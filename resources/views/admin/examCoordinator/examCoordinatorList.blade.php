@extends('admin.layout.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>College List</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive d-flex flex-column">
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
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->first_name }}</td>
                                <td>{{ $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-center">
                                        <a href="#" class="btn btn-primary mr-2" data-index="{{ $index }}">View Detail</a>
                                        <a href="#" class="btn btn-success mr-2" data-index="{{ $index }}">Update</a>
                                        <a href="#" class="btn btn-danger" data-index="{{ $index }}">Delete</a>
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // View Detail button click event
        $('.view-detail').click(function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var firstName = row.find('td:nth-child(2)').text();
            var lastName = row.find('td:nth-child(3)').text();
            var email = row.find('td:nth-child(4)').text();

            // Perform actions with the data (e.g., show a modal with details)
            console.log('View Detail:', firstName, lastName, email);
        });

        // Update button click event
        $('.update').click(function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var firstName = row.find('td:nth-child(2)').text();
            var lastName = row.find('td:nth-child(3)').text();
            var email = row.find('td:nth-child(4)').text();

            // Perform actions with the data (e.g., redirect to update page)
            console.log('Update:', firstName, lastName, email);
        });

        // Delete button click event
        $('.delete').click(function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var firstName = row.find('td:nth-child(2)').text();
            var lastName = row.find('td:nth-child(3)').text();
            var email = row.find('td:nth-child(4)').text();

            // Perform actions with the data (e.g., show a confirmation dialog)
            console.log('Delete:', firstName, lastName, email);
        });
    });
</script>
