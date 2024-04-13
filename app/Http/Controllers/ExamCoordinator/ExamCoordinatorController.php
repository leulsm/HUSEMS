<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Models\ExamSetup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamCoordinatorController extends Controller
{
    //
    public function dashboard()
    {

        $examCoordinatorId = Auth::id();
        $examSetupsCount = ExamSetup::where('exam_coordinator_id', $examCoordinatorId)->count();


        return view('examCoordinator.dashboard.index', compact('examSetupsCount'));
    }



    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
