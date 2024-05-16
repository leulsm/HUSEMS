<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Mail\InvigilatorMail;
use App\Models\ExamPrePass;
use App\Models\ExamSetup;
use App\Models\Invigilator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class InvigilatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $examSetups = ExamSetup::where('exam_coordinator_id', $user->id)->orderBy('updated_at', 'desc')
            ->get();; // Assuming user_id is the foreign key for the user who created the exam setup


        return view('examCoordinator.invigilatorManagement.index', compact('examSetups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $examSetupId = $request->query('examSetupId');
        // $invigilator = Invigilator::where('exam_setup_id', $examSetupId)->orderBy('updated_at', 'desc')->get();
        $examSetup = ExamSetup::findOrFail($examSetupId);
        // dd($examSetup);

        // Retrieve the invigilator for the exam setup
        $invigilator = $examSetup->invigilator;
        return view('examCoordinator.invigilatorManagement.create', compact('examSetupId', 'invigilator', 'examSetup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = User::where('email', $request->email)->first();
        // dd($user);
        if ($user) {
            $ExampasswordPass = str::random(8);

            $invigilator = new Invigilator();
            $invigilator->user_id = $user->id;
            $invigilator->first_name = $request->first_name;
            $invigilator->last_name = $request->last_name;
            $invigilator->email = $request->email;
            $invigilator->phone = $request->phone;
            $invigilator->exam_setup_id = $request->exam_setup_id;
            $invigilator->save();

            //exam_pre_pass
            $examprepass = new ExamPrePass();
            $examprepass->exam_setup_id = $request->exam_setup_id;
            $examprepass->invigilator_id = $invigilator->id;
            $examprepass->exam_password = $ExampasswordPass;
            $examprepass->save();


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

            Mail::to($request->email)->send(new InvigilatorMail($data));

            toastr()->success("Invigilator added Successfully");

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
            $role = Role::findByName('invigilator'); // Replace 'examCoordinator' with the desired role name
            $user->assignRole($role);

            // Create a new Student instance
            $invigilator = new Invigilator();
            $invigilator->user_id = $user->id;
            $invigilator->first_name = $request->first_name;
            $invigilator->last_name = $request->last_name;
            $invigilator->email = $request->email;
            $invigilator->phone = $request->phone;
            $invigilator->exam_setup_id = $request->exam_setup_id;
            $invigilator->save();


            $ExampasswordPass = str::random(8);

            //exam_pre_pass
            $examprepass = new ExamPrePass();
            $examprepass->exam_setup_id = $request->exam_setup_id;
            $examprepass->invigilator_id = $invigilator->id;
            $examprepass->exam_password = $ExampasswordPass;
            $examprepass->save();
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

            Mail::to($request->email)->send(new InvigilatorMail($data));

            toastr()->success("Invigilator added Successfully");

            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $invigilator = Invigilator::findOrFail($id);
        $examSetupId = $invigilator->exam_setup_id;

        return view('examCoordinator.invigilatorManagement.show', compact('invigilator', 'examSetupId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $invigilator = Invigilator::findOrFail($id);
        $examSetupId = $invigilator->exam_setup_id;

        return view('examCoordinator.invigilatorManagement.edit', compact('invigilator', 'examSetupId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $invigilator = Invigilator::findOrFail($id);
        $invigilator->first_name = $request->first_name;
        $invigilator->last_name = $request->last_name;
        $examSetupid = $invigilator->exam_setup_id;

        $invigilator->save();

        toastr()->success("Updated Successfully");

        return redirect()->route('invigilatorManagement.create', ['examSetupId' => $examSetupid]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $invigilator = Invigilator::findOrFail($id);
        $examSetupid = $invigilator->exam_setup_id;

        $invigilator->delete();

        // return redirect()->route('examManagement.index')->with('success', 'Exam setup deleted successfully.');
        toastr()->success("Deleted Successfully");
        return redirect()->route('invigilatorManagement.create', ['examSetupId' => $examSetupid]);
    }
}
