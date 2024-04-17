<?php

namespace App\Http\Controllers\ExamCoordinator;
use App\Http\Requests\Admin\ExamCoordinatorRequest;
use App\Http\Controllers\Controller;
use App\Mail\ExamCoordinatorMail;
use App\Models\ExamCoordinator;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class ExamCoordinatorController extends Controller
{
    //
    public function dashboard()
    {
        // Logic for the admin dashboard
        return view('examCoordinator.dashboard.index');
    }
    public function coordinatorForm(){
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


        $data = [
            'username' => $request->email,
            'password' => $password,
        ];

        Mail::to($request->email)->send(new ExamCoordinatorMail($data));

        toastr()->success("Exam Coordinator added Successfully");

        return back();
    }



    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
