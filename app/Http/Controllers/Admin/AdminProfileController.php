<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function index()
    {
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $admin = $user->admin;

        return view('admin.profile.index', compact('admin'));
    }
    public function updateAdminProfile(Request $request)
    {
        //
        $admin = Admin::findOrFail($id);

        // $examCoordinatorId = Auth::id();


        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        

        $admin->save();


        toastr()->success("Updated Successfully");

        return redirect()->route('updateAdminProfile');
    }


}
