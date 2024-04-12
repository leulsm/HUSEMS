<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamCoordinator\AnswerChoiceRequest;
use App\Models\AnswerOption;
use App\Models\ExamSetup;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $examSetups = ExamSetup::where('exam_coordinator_id', $user->id)->get(); // Assuming user_id is the foreign key for the user who created the exam setup

        return view('examCoordinator.answerChoice.index', compact('examSetups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        // $examSetupId = $request->query('examSetupId');
        // $questions = Question::where('exam_setup_id', $examSetupId)->get();
        // $QuestionAnswers = Question::with('answer_options')->find($examSetupId);
        // $examSetup = ExamSetup::with(['questions', 'questions.answer_options'])->find($examSetupId);
        // return view('examCoordinator.answerChoice.create', compact('examSetup'));
        $examSetupId = $request->query('examSetupId');
        $examSetup = ExamSetup::with('questions')->find($examSetupId);

        $questions = Question::with('answerOptions')
            ->whereHas('examSetup', function ($query) use ($examSetupId) {
                $query->where('id', $examSetupId);
            })
            ->get();

        // $examSetup = ExamSetup::find($examSetupId);

        return view('examCoordinator.answerChoice.create', compact('examSetup', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnswerChoiceRequest $request)
    {
        //
        // dd($request);

        $answerOption = new AnswerOption();
        $answerOption->option_text = $request->option_text;
        $answerOption->is_correct = $request->is_correct;
        $answerOption->question_id = $request->question_id;

        $answerOption->save();

        toastr()->success("Option added Successfully");

        // return redirect()->back()->withInput();
        return redirect()->back()->withInput()->with('active_question', $request->question_id);

        // return redirect()->back()->withInput(['activeQuestionId' => $request->question_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
