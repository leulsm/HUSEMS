<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamCoordinator\QuestionRequest;
use App\Models\ExamSetup;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $examSetups = ExamSetup::where('exam_coordinator_id', $user->id)->get(); // Assuming user_id is the foreign key for the user who created the exam setup

        return view('examCoordinator.question.index', compact('examSetups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $examSetupId = $request->query('examSetupId');
        $questions = Question::where('exam_setup_id', $examSetupId)->orderBy('updated_at', 'desc')->get();
        return view('examCoordinator.question.create', compact('examSetupId', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        $examSetupId = $request->exam_setup_id;
        $examSetup = ExamSetup::findOrFail($examSetupId);

        // Get the total mark of the exam setup
        $totalMark = $examSetup->total_mark;

        // Get the sum of the marks of existing questions for the exam setup
        $existingTotalMark = Question::where('exam_setup_id', $examSetupId)->sum('mark');

        $newQuestionMark = $request->mark;

        if (($existingTotalMark + $newQuestionMark) > $totalMark) {
            // If the total mark exceeds the specified total mark of the exam setup,
            // you can handle the error or display a message to the user.
            toastr()->error("The total mark of the questions exceeds the total mark of the exam setup.");
            return redirect()->back();
        }
        //

        $question = new Question();

        $question->question_type = $request->question_type;
        $question->question_text = $request->question_text;
        $question->mark = $request->mark;
        $question->exam_setup_id = $request->exam_setup_id;

        $question->save();

        toastr()->success("Question added Successfully");

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $question = Question::findOrFail($id);

        return view('examCoordinator.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $question = Question::findOrFail($id);

        return view('examCoordinator.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $question = Question::findOrFail($id);

        // $examCoordinatorId = Auth::id();


        $question->question_type = $request->question_type;
        $question->question_text = $request->question_text;
        $question->mark = $request->mark;

        $question->save();


        toastr()->success("Updated Successfully");

        return redirect()->route('questionManagement.show', ['questionManagement' => $question->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $question = Question::findOrFail($id);
        $examSetupId = $question->exam_setup_id;
        // dd($examSetupId);
        $question->delete();

        // return redirect()->route('examManagement.index')->with('success', 'Exam setup deleted successfully.');
        toastr()->success("Deleted Successfully");
        return redirect()->route('questionManagement.create', ['examSetupId' => $examSetupId],);
    }
}
