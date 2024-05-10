<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AnswerOption;
use App\Models\ExamSetup;
use App\Models\ExamTaken;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TakenExamController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication


        $examSetups = ExamSetup::whereHas('students', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('status', 'Completed');
        })
            ->get();
        return view('student.takenexam.index', compact('examSetups'));
    }

    public function show(string $id)
    {
        $examSetup = ExamSetup::findOrFail($id);
        $studentId = auth()->user()->id; // Assuming you are using authentication and retrieving the current student's ID

        // $examTaken = ExamTaken::where('student_id', $studentId)
        //     ->whereHas('question', function ($query) use ($id) {
        //         $query->where('exam_setup_id', $id);
        //     })
        //     ->get();

        // $totalQuestions = $examTaken->count();
        // $correctAnswersCount = 0;

        // foreach ($examTaken as $taken) {
        //     $questionId = $taken->question_id;
        //     $selectedOptionId = $taken->answer_option_id;

        //     $isCorrect = AnswerOption::where('question_id', $questionId)
        //         ->where('id', $selectedOptionId)
        //         ->value('is_correct');

        //     if ($isCorrect) {
        //         $correctAnswersCount++;
        //     }
        // }

        // $percentageCorrect = ($correctAnswersCount / $totalQuestions) * 100;
        $examSetup = ExamSetup::findOrFail($id);

        // Get the questions for the exam setup
        $questions = Question::where('exam_setup_id', $id)->get();
        $questionsCount = $questions->count();

        // Get the student's answers for the questions
        $answers = ExamTaken::where('student_id', $studentId)
            ->whereIn('question_id', $questions->pluck('id'))
            ->get();

        $answersCount = $answers->count();

        // Calculate the result
        $totalScore = 0;
        $maxScore = 0;
        foreach ($questions as $question) {
            $maxScore += $question->mark;
            // $selectedAnswer = $answers->where('question_id', $question->id)->first();
            // if ($selectedAnswer && $selectedAnswer->answer_option_id == $question->correct_answer_id) {
            //     $totalScore += $question->mark;
            // }
            // $selectedAnswer = $answers->where('question_id', $question->id)->first();
            // $selectedOption = AnswerOption::find($selectedAnswer->answer_option_id);

            // if ($selectedOption && $selectedOption->is_correct) {
            //     $totalScore += $question->mark;
            // }
            $selectedAnswer = $answers->where('question_id', $question->id)->first();

            if ($selectedAnswer && $selectedAnswer->answer_option_id) {
                $selectedOption = AnswerOption::find($selectedAnswer->answer_option_id);

                if ($selectedOption && $selectedOption->is_correct) {
                    $totalScore += $question->mark;
                }
            }
        }
        // Determine the result status
        $status = $totalScore >= $examSetup->pass_mark ? 'Passed' : 'Failed';

        // Calculate the result as a percentage
        $percentage = $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0;

        return view('student.takenexam.show', compact('examSetup', 'totalScore', 'status', 'percentage'));
    }
}
