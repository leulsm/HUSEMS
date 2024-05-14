<?php


namespace App\Http\Controllers\Schedule;

use App\Mail\StudentMail;
use App\Models\ExamSetup;
use App\Models\Student;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

use App\Http\Controllers\Controller;



class ScheduleController extends Controller
{
    public function examList()
    {
        $examSetups = ExamSetup::all(); // Assuming you're using Laravel's built-in authentication
        // $examSetups = ExamSetup::where('exam_coordinator_id', '!=', null)->get();
        $examSetups = ExamSetup::with('schedule')->where('exam_coordinator_id', '!=', null)->get();

        return view('admin.schedule.index', compact('examSetups'));
    }
    public function showExamSetup($examSetupId)
    {
        $examSetup = ExamSetup::find($examSetupId);

        if (!$examSetup) {
            abort(404); // or handle the error in your preferred way
        }

        return view('admin.schedule.setSchedule', ['examSetupId' => $examSetupId, 'examSetup' => $examSetup]);
    }

    public function edit(string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $examSetup = $schedule->examSetup;
        // dd($examSetup);
        return view('admin.schedule.edit', compact('schedule', 'examSetup'));
    }


    public function update(Request $request, string $id)
    {
        $schedule = Schedule::findOrFail($id);


        $schedule->starting_datetime = $request->input('starting_date');
        $schedule->ending_datetime = $request->input('ending_date');

        $schedule->save();
        toastr()->success("Updated Successfully");
        return redirect()->route('examList');
    }
    // Pass the $examSetupId to the view
    //return view('your-view', ['examSetupId' => $examSetupId, 'examSetup' => $examSetup]);


    public function setSchedule(Request $request)
    {

        $schedule = new Schedule;
        $user = Auth::user(); // Get the currently authenticated user

        $examSetupId = $request->query('examSetupId');
        $schedule->user_id = $user->id;
        $schedule->starting_datetime = $request->input('starting_date');
        $schedule->ending_datetime = $request->input('ending_date');
        $schedule->exam_setup_id = $request->input('exam_setup_id');
        $schedule->save();

        toastr()->success("Scheduled Successfully");


        return redirect()->route('examList');


        // $startingDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('starting_date') . ' ' . $request->input('starting_time'));
        // $endingDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('ending_date') . ' ' . $request->input('ending_time'));

        // $currentTime = Carbon::now();
        // $scheduledTime = Carbon::parse($startingDateTime);
        // $endTime = Carbon::parse($endingDateTime);

    }

    public function delete(string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        toastr()->success("Schedule Removed Successfully");
        return redirect()->route('examList');
    }
}
