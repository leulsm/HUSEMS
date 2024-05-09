@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Exam</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('examCoordinator.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('examManagement.index') }}">Exam Setup</a></div>
                <div class="breadcrumb-item active">Edit</div>
            </div>
        </div>
        <div class="row">

            <div class="col-12 col-md-6 col-lg-6">
                <form method="POST" action="{{ route('examManagement.update', $examSetup->id) }}">
                    @csrf
                    @method('PUT') <!-- Add this line to specify the HTTP method for update -->
                    <div class="form-group">
                        <label>Exam Title</label>
                        <input type="text" class="form-control" name="exam_title" value="{{ $examSetup->exam_title }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Exam Type</label>
                        <select class="form-control selectric" name="exam_type">
                            <option value="exit" {{ $examSetup->exam_type === 'exit' ? 'selected' : '' }}>Exit Exam
                            </option>
                            <option value="holistic" {{ $examSetup->exam_type === 'holistic' ? 'selected' : '' }}>Holistic
                                Exam</option>
                            <option value="low" {{ $examSetup->exam_type === 'low' ? 'selected' : '' }}>Low Exam</option>
                            <option value="mock" {{ $examSetup->exam_type === 'mock' ? 'selected' : '' }}>Mock Exam
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Exam Duration Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="duration_time" id="duration_time"
                                value="{{ $examSetup->duration_time }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Total Mark</label>
                        <input type="number" class="form-control" name="total_mark" value="{{ $examSetup->total_mark }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Pass Mark</label>
                        <input type="number" class="form-control" name="pass_mark" value="{{ $examSetup->pass_mark }}"
                            required>
                    </div>
                    <div class=" text-right">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            flatpickr("#duration_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                onClose: function(selectedDates, dateStr, instance) {
                    const selectedTime = instance.parseDate(dateStr, "H:i");
                    const selectedMinutes = selectedTime.getMinutes();

                    if (selectedMinutes < 30) {
                        selectedTime.setMinutes(30);
                        instance.setDate(selectedTime);
                    }
                }

            });
        </script>

    </section>
    {{-- <script>
        flatpickr("#duration_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    </script> --}}
@endsection
