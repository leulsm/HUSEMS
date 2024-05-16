<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Models\CheatReport;
use App\Models\ExamSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheatMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $examSetups = ExamSetup::whereHas('cheatReports')
            ->where('exam_coordinator_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('examCoordinator.cheatReport.index', compact('examSetups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $examSetupId = $request->query('examSetupId');
        // $invigilator = Invigilator::where('exam_setup_id', $examSetupId)->orderBy('updated_at', 'desc')->get();
        $cheatReports = CheatReport::with('student')
            ->where('exam_setup_id', $examSetupId)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('examCoordinator.cheatReport.create', compact('examSetupId', 'cheatReports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        //
        $cheatReport = CheatReport::findOrFail($id);

        // Assuming there's a relationship between CheatReport and Student
        $student = $cheatReport->student;

        // Update the student's status
        $student->status = 'Cheated';
        $student->save();

        toastr()->success("Suspended Successfully");

        return redirect()->route('cheatM.show', $cheatReport->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cheatreport = CheatReport::findOrFail($id);
        $examSetupId = $cheatreport->exam_setup_id;

        return view('examCoordinator.cheatreport.show', compact('cheatreport', 'examSetupId'));
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
