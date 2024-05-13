@extends('admin.layout.master')

@section('content')
    {{-- <div class="main-content"> --}}
    <section class="section">
        <div class="section-header">
            <h1>Collage List</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            @foreach ($list as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item-> first_name}}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary" data-index="{{ $index }}">View Detail</a>
                                        <a href="#" class="btn btn-success"data-index="{{ $index }}">Update</a>
                                        <a href="#" class="btn btn-danger"data-index="{{ $index }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{-- <a href="{{ route('admin.dashboard') }}"><button>HOME</button></a> --}}
                    </table>
                </div>
            </div>
        </div>
    </section>
    {{-- </div> --}}
    {{-- </div> --}}

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
