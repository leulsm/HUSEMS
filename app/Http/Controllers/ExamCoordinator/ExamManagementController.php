<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamCoordinator\ExamSetupRequest;
use App\Models\ExamSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamManagementController extends Controller
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


        return view('examCoordinator.examManagement.index', compact('examSetups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('examCoordinator.examManagement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamSetupRequest $request)
    {
        //
        $examSetup = new ExamSetup();

        $examCoordinatorId = Auth::id();
        // dd($request->duration_time);

        // Create a new ExamSetup instance and assign the user's ID

        $examSetup->exam_coordinator_id = $examCoordinatorId;
        $examSetup->exam_title = $request->exam_title;
        $examSetup->exam_type = $request->exam_type;
        $examSetup->duration_time = $request->duration_time;
        $examSetup->total_mark = $request->total_mark;
        $examSetup->pass_mark = $request->pass_mark;

        $examSetup->save();

        toastr()->success("Created Successfully");

        return to_route('examManagement.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $examSetup = ExamSetup::findOrFail($id);

        return view('examCoordinator.examManagement.show', compact('examSetup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $examSetup = ExamSetup::findOrFail($id);

        return view('examCoordinator.examManagement.edit', compact('examSetup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamSetupRequest $request, string $id)
    {
        //
        $examSetup = ExamSetup::findOrFail($id);

        $examCoordinatorId = Auth::id();

        $examSetup->exam_coordinator_id = $examCoordinatorId;
        $examSetup->exam_title = $request->exam_title;
        $examSetup->exam_type = $request->exam_type;
        $examSetup->duration_time = $request->duration_time;
        $examSetup->total_mark = $request->total_mark;
        $examSetup->pass_mark = $request->pass_mark;

        $examSetup->save();


        toastr()->success("Updated Successfully");

        return redirect()->route('examManagement.show', ['examManagement' => $examSetup->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $examSetup = ExamSetup::findOrFail($id);
        $examSetup->delete();

        // return redirect()->route('examManagement.index')->with('success', 'Exam setup deleted successfully.');
        toastr()->success("Deleted Successfully");
        return redirect()->route('examManagement.index');
    }
}
