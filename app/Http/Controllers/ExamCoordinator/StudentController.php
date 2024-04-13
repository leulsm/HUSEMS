<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamCoordinator\StudentRequest;
use App\Mail\StudentMail;
use App\Models\ExamSetup;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $examSetups = ExamSetup::where('exam_coordinator_id', $user->id)->get(); // Assuming user_id is the foreign key for the user who created the exam setup

        return view('examCoordinator.student.index', compact('examSetups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $examSetupId = $request->query('examSetupId');
        return view('examCoordinator.student.create', compact('examSetupId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        //
        // Create a random password
        $password = str::random(8);

        // Create a new User instance
        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($password); // Hash the password
        $user->save();

        // Assign a role to the user
        $role = Role::findByName('student'); // Replace 'examCoordinator' with the desired role name
        $user->assignRole($role);

        // Create a new Student instance
        $student = new Student();
        $student->user_id = $user->id;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->exam_setup_id = $request->exam_setup_id;
        $student->save();

        // Retrieve the exam title
        $examSetup = ExamSetup::find($request->exam_setup_id);
        $examTitle = $examSetup->exam_title;

        $data = [
            'username' => $request->email,
            'password' => $password,
            'exam_title' => $examTitle
        ];

        Mail::to($request->email)->send(new StudentMail($data));

        toastr()->success("Student added Successfully");

        return back();
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
