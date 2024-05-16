<?php

namespace App\Http\Controllers\Invigilator;

use App\Http\Controllers\Controller;
use App\Models\ExamSetup;
use App\Models\Invigilator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignedExamController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $invigilator = Invigilator::where('user_id', $user->id)->first(); // Retrieve the student based on the user_id

        // $examSetup = ExamSetup::find($student->exam_setup_id); // Retrieve the assigned exam setup

        $examSetups = ExamSetup::whereHas('invigilator', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->whereIn('status', ['Active', 'Pending']);
        })
            ->get();

        return view('invigilator.assigned.index', compact('examSetups'));
    }

    public function show(string $id)
    {
        // $examSetup = ExamSetup::findOrFail($id);
        // $schdule = $examSetup->id;
        $examSetup = ExamSetup::with('schedule')->findOrFail($id);

        // Access the associated schedule
        $schedule = $examSetup->schedule;
        $start_time = $schedule->starting_datetime;
        // return view('student.upcomingexam.show', compact('examSetup', 'start_time'));
        $startTime = Carbon::parse($schedule->starting_datetime);
        $currentTime = Carbon::now();
        $remainingTime = $currentTime->diffInSeconds($startTime, false);

        return view('invigilator.assigned.show', compact('examSetup', 'remainingTime', 'start_time', 'currentTime'));
    }
}
