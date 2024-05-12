@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Question</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('examCoordinator.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('questionManagement.index') }}">Exam Setup</a></div>
                <div class="breadcrumb-item active">Edit Questiion</div>
            </div>
        </div>
        <div class="row">

            <div class="col-12 col-md-6 col-lg-6">
                <form method="POST" action="{{ route('questionManagement.update', $question->id) }}">
                    @csrf
                    @method('PUT') <!-- Add this line to specify the HTTP method for update -->
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <div class="form-group">
                        <label>Question Type</label>
                        <select class="form-control selectric" name="question_type">
                            <option value="choice"{{ $question->question_type === 'choice' ? 'selected' : '' }}>Choice
                            </option>
                            <option value="truefalse"{{ $question->question_type === 'truefalse' ? 'selected' : '' }}>
                                True/False
                            </option>
                            <option value="match"{{ $question->question_type === 'match' ? 'selected' : '' }}>Match
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Question Title</label>
                        <input type="text" class="form-control" name="question_text"
                            value="{{ $question->question_text }}" required>
                    </div>
                    <div class="form-group">
                        <label>Question Mark</label>
                        <input type="number" class="form-control" name="mark" min="1"
                            value="{{ $question->mark }}" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>

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
@endsection
