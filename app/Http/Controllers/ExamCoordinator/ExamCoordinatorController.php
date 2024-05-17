<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Requests\Admin\ExamCoordinatorRequest;
use App\Http\Controllers\Controller;
use App\Mail\ExamCoordinatorMail;
use App\Models\ExamCoordinator;
use App\Models\User;
use App\Models\ExamSetup;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class ExamCoordinatorController extends Controller
{
    //
    public function dashboard()
    {



        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication
        $examCoordinator = $user->examCoordinator;

        $examSetupsCount = ExamSetup::where('exam_coordinator_id', $user->id)->count();
        $takenExamSetupsCount = ExamSetup::where('exam_coordinator_id', $user->id)
            ->where('status', 1)
            ->count();

        $examSetups = ExamSetup::where('exam_coordinator_id', $user->id)->get();

        $examSetups = ExamSetup::where('exam_coordinator_id', $user->id)->withCount('students', 'questions')->get();

        $labels = $examSetups->pluck('exam_title')->toArray();
        $studentData = $examSetups->pluck('students_count')->toArray();
        $questionData = $examSetups->pluck('questions_count')->toArray();


        $studentCount = $examSetups->sum(function ($examSetup) {
            return $examSetup->students->count();
        });
        $questionCount = $examSetups->sum(function ($examSetup) {
            return $examSetup->questions->count();
        });

        return view('examCoordinator.dashboard.index', compact('examSetupsCount', 'studentCount', 'questionCount', 'labels', 'studentData', 'questionData', 'takenExamSetupsCount'));
    }
    public function coordinatorForm()
    {
        return view('admin.examCoordinator.examCoordinatorForm');
    }

    public function storeCoordinator(Request $request)
    {
        //
        // Create a random password
        $password = str::random(8);

        // Create a new User instance
        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        //$user->phone = $request->phone;
        $user->password = bcrypt($password); // Hash the password
        $user->save();

        // Assign a role to the user
        $role = Role::findByName('examCoordinator'); // Replace 'examCoordinator' with the desired role name
        $user->assignRole($role);

        // Create a new Student instance
        $examCoordinator = new ExamCoordinator();
        $examCoordinator->user_id = $user->id;
        $examCoordinator->first_name = $request->first_name;
        $examCoordinator->last_name = $request->last_name;
        $examCoordinator->email = $request->email;
        $examCoordinator->phone = $request->phone;
        $examCoordinator->save();
        $fullname =   $request->first_name . ' ' . $request->last_name;


        $data = [
            'fullname' => $fullname,
            'email' => $request->email,
            'password' => $password,
        ];

        Mail::to($request->email)->send(new ExamCoordinatorMail($data));

        toastr()->success("Exam Coordinator added Successfully");

        return back();
    }


    function examCoordinatorList()
    {

        $list = examCoordinator::all();

        return view('admin.examCoordinator.examCoordinatorList', compact('list'));
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



    function examCoordinatorDetail(string $id)
    {
        $examCoordinator = ExamCoordinator::findOrFail($id);
        //$examSetupId = $student->exam_setup_id;
        return view('admin.examCoordinator.examCoordinatordetail', compact('examCoordinator'));
    }
    function examCoordinatorEdit(string $id)
    {
        $examCoordinator = ExamCoordinator::findOrFail($id);
        //$examSetupId = $student->exam_setup_id;
        return view('admin.examCoordinator.examCoordinatoredit', compact('examCoordinator'));
    }
    public function examCoordinatorUpdate(Request $request, string $id)
    {
        $examCoordinator = ExamCoordinator::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $examCoordinator->first_name = $request->input('first_name');
        $examCoordinator->last_name = $request->input('last_name');
        $examCoordinator->email = $request->input('email');
        $examCoordinator->phone = $request->input('phone');
        $examCoordinator->save();

        return redirect()->route('examCoordinatorList')->with('success', 'ExamCoordinator updated successfully.');
    }

    public function destroyexamCoordinator(string $id)
    {
        $examCoordinator = ExamCoordinator::findOrFail($id);
        $examCoordinator->delete();

        return redirect()->route('examCoordinatorList', $examCoordinator->id)->with('success', 'Exam Coordinator deleted successfully.');
    }

    public function searchExamCoordinator(Request $request)
    {
        $searchValue = $request->input('search');

        $examCoordinator = ExamCoordinator::where('first_name', 'LIKE', '%' . $searchValue . '%')->get();
        $examCoordinator = ExamCoordinator::where('last_name', 'LIKE', '%' . $searchValue . '%')->get();



        return view('admin.examCoordinator.examCoordinatorList', ['list' => $examCoordinator]);
    }
}
