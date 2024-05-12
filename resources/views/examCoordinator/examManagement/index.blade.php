@extends('examCoordinator.layout.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Exam</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('examCoordinator.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Exam Setup</div>
            </div>
        </div>
        <div class="row">

            <div class="col-12 col-md-6 col-lg-6">
                <form method="POST" action="{{ route('examManagement.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Exam Title</label>
                        <input type="text" class="form-control" name="exam_title" required>
                    </div>
                    <div class="form-group">
                        <label>Exam Type</label>
                        <select class="form-control selectric" name="exam_type">
                            <option value="exit">Exit Exam</option>
                            <option value="holistic">Holistic Exam</option>
                            <option value="low">Low Exam</option>
                            <option value="mock">Mock Exam</option>
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

                            <input type="text" class="form-control" name="duration_time" id="duration_time">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Total Mark</label>
                        <input type="number" class="form-control" name="total_mark" required>
                    </div>
                    <div class="form-group">
                        <label>Pass Mark</label>
                        <input type="number" class="form-control" name="pass_mark" required>
                    </div>

                    <div class=" text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                Recent Exam Setups
                <div class="card ">
                    <div class="card-body" id="top-5-scroll">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach ($examSetups as $examSetup)
                                <li class="media">
                                    <!-- Display exam setup details -->
                                    <img class="mr-3 rounded" width="55"
                                        src="{{ asset('admin/assets/img/products/product-3-50.png') }}" alt="product">
                                    <div class="media-body">
                                        <div class="media-title">{{ $examSetup->exam_title }}</div>
                                        <div class="mt-1">
                                            <!-- Display number of students -->
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary"
                                                    data-width="{{ $examSetup->students->count() }}%"></div>
                                                <div class="budget-price-label">{{ $examSetup->students->count() }} Students
                                                </div>
                                            </div>
                                            <!-- Display number of questions -->
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger"
                                                    data-width="{{ $examSetup->questions->count() }}%"></div>
                                                <div class="budget-price-label">{{ $examSetup->questions->count() }}
                                                    Questions</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-right">
                                        <!-- Display edit and view buttons -->
                                        @if ($examSetup->status == 0)
                                            <a href="{{ route('examManagement.edit', $examSetup->id) }}"
                                                class="btn btn-primary px2"><i class="fas fa-edit"></i></a>
                                        @endif
                                        <a href="{{ route('examManagement.show', $examSetup->id) }}"
                                            class="btn btn-success"><i class="fas fa-eye"></i></a>
                                    </div>
                                    <!-- Conditionally display add question button -->
                                    @if ($examSetup->status == 1)
                                        <!-- Display "taken" text and disable clickable links/buttons -->
                                        <span class="taken-text">Taken Exam</span>
                                    @else
                                        <!-- Display add question button -->
                                        <a
                                            href="{{ route('questionManagement.create', ['examSetupId' => $examSetup->id]) }}">
                                            <form action="GET" class="dropzone1" id="mydropzone">
                                                <div class="add-question"><i class="fas fa-plus px-2"></i></div>
                                                <p class="px-2">Question</p>
                                            </form>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
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

                    if (selectedMinutes < 5) {
                        selectedTime.setMinutes(5);
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
