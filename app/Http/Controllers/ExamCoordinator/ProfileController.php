<?php

namespace App\Http\Controllers\ExamCoordinator;

use App\Http\Controllers\Controller;
use App\Models\ExamCoordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        $examCoordinator = $user->examCoordinator;

        return view('examCoordinator.profile.index', compact('examCoordinator'));
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
    public function store(Request $request)
    {
        //
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
        $examCoordinator = ExamCoordinator::findOrFail($id);

        // $examCoordinatorId = Auth::id();


        $examCoordinator->first_name = $request->first_name;
        $examCoordinator->last_name = $request->last_name;

        $examCoordinator->save();


        toastr()->success("Updated Successfully");

        return redirect()->route('profileManagement.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
