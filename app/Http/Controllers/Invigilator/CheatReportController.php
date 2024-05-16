<?php

namespace App\Http\Controllers\Invigilator;

use App\Http\Controllers\Controller;
use App\Models\CheatReport;
use App\Models\ExamSetup;
use App\Models\Invigilator;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheatReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $invigilator = Invigilator::where('user_id', $user->id)->first(); // Retrieve the student based on the user_id

        // $examSetup = ExamSetup::find($student->exam_setup_id); // Retrieve the assigned exam setup

        $examSetups = ExamSetup::whereHas('invigilator', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->whereIn('status', ['Active',]);
        })
            ->get();

        return view('invigilator.cheatreport.index', compact('examSetups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $examSetupId = $request->query('examSetupId');
        // dd($examSetupId);
        $students = Student::where('exam_setup_id', $examSetupId)->orderBy('updated_at', 'desc')->get();
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication
        // dd($students);
        // $cheatReports = CheatReport::where('exam_setup_id', $examSetupId)->orderBy('updated_at', 'desc')->get();
        $cheatReports = CheatReport::with('student')
            ->where('exam_setup_id', $examSetupId)
            ->orderBy('updated_at', 'desc')
            ->get();
        $invigilator = Invigilator::where('user_id', $user->id)->first();
        return view('invigilator.cheatreport.create', compact('examSetupId', 'students', 'invigilator', 'cheatReports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $cheatreport = new CheatReport();

        // $examSetup = new ExamSetup();

        // $examCoordinatorId = Auth::id();
        // dd($request->duration_time);

        // Create a new ExamSetup instance and assign the user's ID


        $cheatreport->exam_setup_id = $request->exam_setup_id;
        $cheatreport->invigilator_id = $request->invigilator_id;
        $cheatreport->student_id = $request->student_id;
        $cheatreport->description = $request->description;

        $cheatreport->save();

        toastr()->success("Reported Successfully");

        return to_route('cheatManagement.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cheatreport = CheatReport::findOrFail($id);
        $examSetupId = $cheatreport->exam_setup_id;

        return view('invigilator.cheatreport.show', compact('cheatreport', 'examSetupId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cheatReport = CheatReport::findOrFail($id);

        $students = Student::where('exam_setup_id', $cheatReport->exam_setup_id)->orderBy('updated_at', 'desc')->get();


        return view('invigilator.cheatreport.edit', compact('cheatReport', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cheatReport = CheatReport::findOrFail($id);



        $cheatReport->student_id = $request->student_id;
        $cheatReport->description = $request->description;


        $cheatReport->save();


        toastr()->success("Updated Successfully");

        return redirect()->route('cheatManagement.show', ['cheatManagement' => $cheatReport->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $examSetup = CheatReport::findOrFail($id);
        $examSetup->delete();

        // return redirect()->route('examManagement.index')->with('success', 'Exam setup deleted successfully.');
        toastr()->success("Deleted Successfully");
        return redirect()->route('cheatManagement.index');
    }
}
