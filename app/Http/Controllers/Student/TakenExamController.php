<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamSetup;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TakenExamController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        // $student = Student::where('user_id', $user->id)
        //     ->whereIn('status', ['Completed'])
        //     ->first(); // Retrieve the student based on the user_id and status

        // if ($student) {
        //     $examSetups = ExamSetup::where('student_id', $student->id)->get(); // Retrieve all exam setups assigned to the student

        //     return view('student.takenexam.index', compact('examSetups'));
        // } else {
        //     // Handle the case when the student is not active or pending

        //     return view('student.takenexam.index', ['examSetups' => null]);

        //     // return redirect()->route('student.inactive');
        // }
        // return view('student.takenexam.index', compact('examSetups'));
        // $user = Auth::user();

        // $examSetups = ExamSetup::whereHas('students', function ($query) use ($user) {
        //     $query->where('user_id', $user->id);
        // })
        //     ->where('status', 'Completed')
        //     ->get();
        $examSetups = ExamSetup::whereHas('students', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('status', 'Completed');
        })
            ->get();
        return view('student.takenexam.index', compact('examSetups'));
    }
}
