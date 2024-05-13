<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\SubmitQuestionRequest;
use App\Models\ExamSetup;
use App\Models\ExamTaken;
use App\Models\Question;
use App\Models\Student;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class UpcomingExamController extends Controller
{
    //
    public function index()
    {
// <<<<<<< scheduler
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

    $student = Student::where('user_id', $user->id)->first(); // Retrieve the student based on the user_id

    $examSetup = ExamSetup::find($student->exam_setup_id); // Retrieve the assigned exam setup

    $schedule = Schedule::where('exam_setup_id', $student->exam_setup_id)->first(); // Retrieve the schedule using exam_setup_id

    $timeRemainingToStart = null;

    if ($schedule) {
        //$startingDatetimeDb = Carbon::parse($schedule->starting_datetime);
        $startingDatetimeDb = Carbon::parse('2024-05-13 10:44:00');
        $startingDatetime = substr($startingDatetimeDb, 0, -3);
        $currentTime = Carbon::now()->timezone('Africa/Nairobi'); // Assuming East Africa Time
        $scheduledTime = Carbon::parse($startingDatetime); // Assuming East Africa Time
        $timeRemainingToStart = max($currentTime->diffInSeconds($scheduledTime) - 10750, 0);
        // Format the remaining time
// =======

//         $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        // $student = Student::where('user_id', $user->id)
        //     ->whereIn('status', ['Active', 'Pending'])
        //     ->first(); // Retrieve the student based on the user_id and status

        // if ($student) {
        //     $examSetups = ExamSetup::where('student_id', $student->id)->get(); // Retrieve all exam setups assigned to the student

        //     return view('student.upcomingexam.index', compact('examSetups'));
        // } else {
        //     // Handle the case when the student is not active or pending

        //     return view('student.upcomingexam.index', ['examSetups' => null]);

        //     // return redirect()->route('student.inactive');
        // }
        // $examSetups = ExamSetup::whereHas('students', function ($query) use ($user) {
        //     $query->where('user_id', $user->id);
        // })
        //     ->where('status', ['Active', 'Pending'])
        //     ->get();
//         $examSetups = ExamSetup::whereHas('students', function ($query) use ($user) {
//             $query->where('user_id', $user->id)
//                 ->whereIn('status', ['Active', 'Pending']);
//         })
//             ->get();
//         return view('student.upcomingexam.index', compact('examSetups'));
// >>>>>>> dev
    }
       $examSetups = ExamSetup::whereHas('students', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->whereIn('status', ['Active', 'Pending']);
        })
            ->get();

    return view('student.upcomingexam.index', compact('examSetup', 'timeRemainingToStart','examSetups'));


    }




    public function create(Request $request)
    {
        // Logic for the admin dashboard

        // Retrieve the assigned exam setup
        // $student = $user->student;

        $examSetupId = $request->query('examSetupId');
        $examSetup = ExamSetup::with('questions')->find($examSetupId);

        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $student = $user->students()->where('exam_setup_id', $examSetupId)->first();

        // dd($student);

        $questions = Question::with('answerOptions')
            ->whereHas('examSetup', function ($query) use ($examSetupId) {
                $query->where('id', $examSetupId);
            })
            ->get();

        $examSetup = ExamSetup::findOrFail($examSetupId);

        // Update the examStatus to 'Active'
        $student->status = 'Active';
        $student->save();

        // Calculate the exam end time based on the allowed time
        $duration = $examSetup->duration_time; // Assuming $duration_time is in the format "00:30:00"

        // Extract hours, minutes, and seconds from the duration
        list($hours, $minutes, $seconds) = explode(':', $duration);

        // Calculate the total duration in minutes
        $totalMinutes = ($hours * 60) + $minutes;

        // Calculate the exam end time based on the total duration
        $endTime = Carbon::now()->addMinutes($totalMinutes);
        // Store the exam end time in the user's session
        $endTimeFormatted = $endTime->format('D M d Y H:i:s e');
        session(['exam_end_time' => $endTimeFormatted]);

        // dd($endTime);


        return view('student.upcomingexam.create', compact('examSetup', 'questions'));
    }

    public function store(SubmitQuestionRequest $request)
    {
        // Logic for the admin dashboard

        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication
        // Retrieve the assigned exam setup
        // question_id
        $examTaken = new ExamTaken();
        $examTaken->answer_option_id = $request->answer_option_id;
        $examTaken->question_id = $request->question_id;
        $examTaken->student_id = $user->id;


        $examTaken->save();

        toastr()->success("Answer Saved");


        // return view('student.upcomingexam.create', compact('examSetup', 'questions'));
        return redirect()->back()->withInput()->with('active_question', $request->question_id);
    }

    public function submit(Request $request)
    {

        // $user = Auth::user(); // Assuming you're using Laravel's built-in authentication
        // // Retrieve the assigned exam setup
        // $student = $user->student;

        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication
        $examSetupId = $request->query('examSetupId');

        $student = $user->students()->where('exam_setup_id', $examSetupId)->first();

        // Update the examStatus to 'Active'
        $student->status = 'Completed';
        $student->save();

        toastr()->success("Submmitted Exam Answer Saved!");

        return view('student.dashboard.index');
    }
}
