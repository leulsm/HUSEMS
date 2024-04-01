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
        return view('examCoordinator.examManagement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamSetupRequest $request)
    {
        //
        $examSetup = new ExamSetup();

        $examCoordinatorId = Auth::id();

        // Create a new ExamSetup instance and assign the user's ID

        $examSetup->exam_coordinator_id = $examCoordinatorId;
        $examSetup->exam_title = $request->exam_title;
        $examSetup->exam_type = $request->exam_type;
        $examSetup->date = $request->date;
        $examSetup->time = $request->time;
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
