<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\SubmitQuestionRequest;
use App\Models\ExamSetup;
use App\Models\ExamTaken;
use App\Models\Question;
use App\Models\Student;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class UpcomingExamController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

    $student = Student::where('user_id', $user->id)->first(); // Retrieve the student based on the user_id

    $examSetup = ExamSetup::find($student->exam_setup_id); // Retrieve the assigned exam setup

    $schedule = Schedule::where('exam_setup_id', $student->exam_setup_id)->first(); // Retrieve the schedule using exam_setup_id

    $timeRemainingToStart = null;

    if ($schedule) {
        $startingDatetimeDb = Carbon::parse($schedule->starting_datetime);
        $startingDatetime = substr($startingDatetimeDb, 0, -3);
        $currentTime = Carbon::now()->timezone('Africa/Nairobi'); // Assuming East Africa Time
        $scheduledTime = Carbon::parse($startingDatetime); // Assuming East Africa Time
        $timeRemainingToStart = $currentTime->diffInSeconds($scheduledTime)-10710;
        // Format the remaining time
    }

    return view('student.upcomingexam.index', compact('examSetup', 'timeRemainingToStart'));


    }




    public function create(Request $request)
    {
        // Logic for the admin dashboard

        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication
        // Retrieve the assigned exam setup
        $examSetupId = $request->query('examSetupId');
        $examSetup = ExamSetup::with('questions')->find($examSetupId);

        $questions = Question::with('answerOptions')
            ->whereHas('examSetup', function ($query) use ($examSetupId) {
                $query->where('id', $examSetupId);
            })
            ->get();


        return view('student.upcomingexam.create', compact('examSetup', 'questions'));
    }

    public function store(SubmitQuestionRequest $request)
    {
        // Logic for the admin dashboard

        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication
        // Retrieve the assigned exam setup

        $examTaken = new ExamTaken();
        $examTaken->answer_option_id = $request->answer_option_id;
        $examTaken->student_id = $user->id;


        $examTaken->save();

        toastr()->success("Answer Saved");


        // return view('student.upcomingexam.create', compact('examSetup', 'questions'));
        return redirect()->back()->withInput()->with('active_question', $request->question_id);
    }
}
