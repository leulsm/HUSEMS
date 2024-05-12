<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamCoordinator\StudentRequest;
use App\Mail\StudentMail;
use App\Models\ExamSetup;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Vtiful\Kernel\Excel;

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
        $students = Student::where('exam_setup_id', $examSetupId)->orderBy('updated_at', 'desc')->get();
        return view('examCoordinator.student.create', compact('examSetupId', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        // dd($user);
        if ($user) {
            // $password = str::random(8);

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
            $fullname = $request->first_name . ' ' . $request->last_name;;
            $examDate = $examSetup->created_at;
            $formattedDate = Carbon::parse($examDate)->format('M d, Y');
            $formattedTime = Carbon::parse($examDate)->format('h:i A');
            $data = [
                'fullname' => $fullname,
                'date' => $formattedDate,
                'time' => $formattedTime,
                'urllink' => "http://127.0.0.1:8000/",
                'password' => "Use your previous password.",
                'exam_title' => $examTitle
            ];

            Mail::to($request->email)->send(new StudentMail($data));

            toastr()->success("Student added Successfully");

            return back();
        } else {
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
            $fullname =  $request->first_name . ' ' . $request->last_name;;

            $examDate = $examSetup->created_at;
            $formattedDate = Carbon::parse($examDate)->format('M d, Y');
            $formattedTime = Carbon::parse($examDate)->format('h:i A');

            $data = [
                'fullname' => $fullname,
                'date' => $formattedDate,
                'time' => $formattedTime,
                'urllink' => "http://127.0.0.1:8000/",
                'password' => $password,
                'exam_title' => $examTitle
            ];

            Mail::to($request->email)->send(new StudentMail($data));

            toastr()->success("Student added Successfully");

            return back();
        }
    }
    public function storebulk(Request $request)
    {
        // $request->validate([
        //     'bulk_data' => 'required|file|mimes:csv', // Validate the uploaded file
        // ]);


        $file = $request->file('bulk_data'); // Get the uploaded file
        dd($file);

        // Process the CSV file
        $csvData = array_map('str_getcsv', file($file));
        $headers = array_shift($csvData); // Get the headers (first row) of the CSV file

        foreach ($csvData as $row) {
            // Process each row of data from the CSV file

            $userData = array_combine($headers, $row);

            $user = User::where('email', $userData['email'])->first();
            // Combine headers with data for each row
            if ($user) {

                $student = new Student();
                $student->user_id = $user->id;
                $student->first_name = $userData['first_name'];
                $student->last_name = $userData['last_name'];
                $student->email = $userData['email'];
                $student->phone = $userData['phone'];
                $student->exam_setup_id = $request->exam_setup_id;
                $student->save();

                // Retrieve the exam title
                $examSetup = ExamSetup::find($request->exam_setup_id);
                $examTitle = $examSetup->exam_title;
                $fullname =  $userData['first_name'] . ' ' . $userData['last_name'];
                $examDate = $examSetup->created_at;
                $formattedDate = Carbon::parse($examDate)->format('M d, Y');
                $formattedTime = Carbon::parse($examDate)->format('h:i A');
                $data = [
                    'fullname' => $fullname,
                    'date' => $formattedDate,
                    'time' => $formattedTime,
                    'urllink' => "http://127.0.0.1:8000/",
                    'password' => "Use your previous password.",
                    'exam_title' => $examTitle
                ];

                Mail::to($userData['email'])->send(new StudentMail($data));

                // toastr()->success("Student added Successfully");

                // return back();
            } else {

                $password = str::random(8);

                // Create a new User instance
                $user = new User();
                $user->name = $userData['first_name'] . ' ' . $userData['last_name'];
                $user->email = $userData['email'];
                $user->password = bcrypt($password); // Hash the password
                $user->save();

                // Assign a role to the user
                $role = Role::findByName('student'); // Replace 'examCoordinator' with the desired role name
                $user->assignRole($role);

                // Create a new Student instance
                $student = new Student();
                $student->user_id = $user->id;
                $student->first_name = $userData['first_name'];
                $student->last_name = $userData['last_name'];
                $student->email = $userData['email'];
                $student->phone = $userData['phone'];
                $student->exam_setup_id = $request->exam_setup_id;
                $student->save();

                // Retrieve the exam title
                $examSetup = ExamSetup::find($request->exam_setup_id);
                $examTitle = $examSetup->exam_title;
                $fullname =  $userData['first_name'] . ' ' . $userData['last_name'];

                $examDate = $examSetup->created_at;
                $formattedDate = Carbon::parse($examDate)->format('M d, Y');
                $formattedTime = Carbon::parse($examDate)->format('h:i A');

                $data = [
                    'fullname' => $fullname,
                    'date' => $formattedDate,
                    'time' => $formattedTime,
                    'urllink' => "http://127.0.0.1:8000/",
                    'password' => $password,
                    'exam_title' => $examTitle
                ];

                Mail::to($userData['email'])->send(new StudentMail($data));
            }
        }

        toastr()->success("Bulk student registration completed successfully");

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $student = Student::findOrFail($id);
        $examSetupId = $student->exam_setup_id;


        return view('examCoordinator.student.show', compact('student', 'examSetupId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $student = Student::findOrFail($id);
        $examSetupId = $student->exam_setup_id;

        return view('examCoordinator.student.edit', compact('student', 'examSetupId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $student = Student::findOrFail($id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $examSetupid = $student->exam_setup_id;

        $student->save();

        toastr()->success("Updated Successfully");

        return redirect()->route('studentManagement.create', ['examSetupId' => $examSetupid]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $student = Student::findOrFail($id);
        $examSetupid = $student->exam_setup_id;

        $student->delete();

        // return redirect()->route('examManagement.index')->with('success', 'Exam setup deleted successfully.');
        toastr()->success("Deleted Successfully");
        return redirect()->route('studentManagement.create', ['examSetupId' => $examSetupid]);
    }
}
