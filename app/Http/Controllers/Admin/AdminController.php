<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\College;
use App\Models\Department;
use App\Models\ExamCoordinator;
use App\Models\ExamSetup;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        // Logic for the admin dashboard
        $collegeCount = College::count();
        $departmentCount = Department::count();
        $examCoordinatorCount = ExamCoordinator::count();
        $examSetupCount = ExamSetup::count();
        $scheduleCount = Schedule::count();

        // Example code for generating graphs using Chart.js
        $chartLabels = ['Colleges', 'Departments', 'Exam Coordinators', 'Exam Setups', 'Schedules'];
        $chartData = [$collegeCount, $departmentCount, $examCoordinatorCount, $examSetupCount, $scheduleCount];

        return view('admin.dashboard.index', compact('chartLabels', 'chartData'));
        
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
