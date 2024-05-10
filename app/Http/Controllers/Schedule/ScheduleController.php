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
    public function examList(){
        $examSetups = ExamSetup::all(); // Assuming you're using Laravel's built-in authentication
        $examSetups = ExamSetup::where('exam_coordinator_id', '!=', null)->get();

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



        // Pass the $examSetupId to the view
        //return view('your-view', ['examSetupId' => $examSetupId, 'examSetup' => $examSetup]);


    public function setSchedule(Request $request){

        $schedule = new Schedule;
        $user = Auth::user(); // Get the currently authenticated user

        $examSetupId = $request->query('examSetupId');
        $schedule->user_id = $user->id;
        $schedule->starting_datetime = $request->input('starting_date');
        $schedule->ending_datetime = $request->input('ending_date');
        $schedule->exam_setup_id = $request->input('exam_setup_id');
        $schedule->save();

        return redirect()->route('admin.dashboard');


            // $startingDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('starting_date') . ' ' . $request->input('starting_time'));
            // $endingDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('ending_date') . ' ' . $request->input('ending_time'));

            // $currentTime = Carbon::now();
            // $scheduledTime = Carbon::parse($startingDateTime);
            // $endTime = Carbon::parse($endingDateTime);

    }
}
