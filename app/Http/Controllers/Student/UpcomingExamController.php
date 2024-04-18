<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\SubmitQuestionRequest;
use App\Models\ExamSetup;
use App\Models\ExamTaken;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpcomingExamController extends Controller
{
    //
    public function index()
    {
        // Logic for the admin dashboard

        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $student = Student::where('user_id', $user->id)->first(); // Retrieve the student based on the user_id

        $examSetup = ExamSetup::find($student->exam_setup_id); // Retrieve the assigned exam setup

        return view('student.upcomingexam.index', compact('examSetup'));
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
