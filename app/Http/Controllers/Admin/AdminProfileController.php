<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function updateAdminProfile()
    {
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $admins = $user->admins;

        return view('admin.profile.index', compact('admins'));
    }
}
