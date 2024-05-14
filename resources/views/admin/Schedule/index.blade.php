@extends('admin.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam Setup</h1>
        </div>

        <div class="row">
            @foreach ($examSetups as $examSetup)
                <div class="col-md-4">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="far fa-clock fa-3x text-primary"></i>
                            </div>
                            <h4>{{ $examSetup->exam_title }}</h4>
                            <div class="card-description">{{ $examSetup->exam_type }}</div>
                        </div>
                        <div class="card-body p-0">
                            <div class="tickets-list">
                                <a class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>Date and Time</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>{{ $examSetup->date }} {{ $examSetup->time }}</div>
                                    </div>
                                </a>
                                <div class="row">
                                    <div class="col-6">
                                        <a class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Total Mark</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>{{ $examSetup->total_mark }}</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Pass Mark</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>{{ $examSetup->pass_mark }}</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @if ($examSetup->schedule)
                                    <div class="row p-3">
                                        <div class="col-9">
                                            <p>Schedule is Already settled.</p>
                                        </div>
                                        {{-- <div class="col-1">
                                            <a href="{{ route('editSchedule', $examSetup->schedule->id) }}"> <i
                                                    class="fas fa-edit text-green"></i></a>

                                        </div> --}}
                                        <div class="col-1">
                                            <a href="{{ route('editSchedule', $examSetup->schedule->id) }}">
                                                <i class="fas fa-edit" style="color: green;"></i>
                                            </a>
                                        </div>
                                        {{-- <div class="col-1">
                                            <a href="{{ route('deleteSchedule', $examSetup->schedule->id) }}"> <i
                                                    class="fas fa-trash text-green"></i></a>
                                        </div> --}}
                                        <div class="col-1 mr-3">
                                            <a href="#"
                                                onclick="confirmDelete('{{ route('deleteSchedule', $examSetup->schedule->id) }}')">
                                                <i class="fas fa-trash text-green" style="color: red;"></i>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('createSchedule', ['examSetupId' => $examSetup->id]) }}"
                                        class="">
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="GET" class="dropzone" id="mydropzone">
                                                    <div class="mx-auto my-3 add-question">Set Schedule</div>
                                                </form>
                                            </div>
                                        </div>
                                    </a>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



    </section>
    <script>
        function confirmDelete(url) {
            if (confirm("Are you sure you want to delete this schedule?")) {
                window.location.href = url; // Redirect to the delete route if user confirms
            }
        }
    </script>
@endsection
