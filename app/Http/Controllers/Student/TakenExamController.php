<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TakenExamController extends Controller
{
    //
    public function index()
    {
        // Logic for the admin dashboard

        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $examSetups = ExamSetup::where('exam_coordinator_id', $user->id)->get(); // Assuming user_id is the foreign key for the user who created the exam setup


        return view('student.takenexam.index', compact('examSetups'));
    }
}
