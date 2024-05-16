<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ExamCoordinator\AnswerChoiceController;
use App\Http\Controllers\ExamCoordinator\ExamCoordinatorController;
use App\Http\Controllers\ExamCoordinator\ExamManagementController;
use App\Http\Controllers\ExamCoordinator\QuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\ExamCoordinator\StudentController as StudentC;
use App\Http\Controllers\ExamCoordinator\ProfileController as ProfileC;
use App\Http\Controllers\Student\TakenExamController;
use App\Http\Controllers\Student\UpcomingExamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\College\CollegeController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\ExamCoordinator\CheatMController;
use App\Http\Controllers\ExamCoordinator\InvigilatorController;
use App\Http\Controllers\Invigilator\AssignedExamController;
use App\Http\Controllers\Invigilator\CheatReportController;
use App\Http\Controllers\Schedule\ScheduleController;
// use App\Http\Controllers\Student\StudentProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Routes accessible to users with the 'admin' role
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('admin/department/departmentForm', [DepartmentController::class, 'storeDepartment'])->name('admin.addDepartment');
    // Route::post('admin/department/save', [DepartmentController::class, 'storeDepartment'])->name('admin.storeDep');
});

// examCoordinator
Route::middleware(['auth', 'role:examCoordinator'])->group(function () {
    // Routes accessible to users with the 'admin' role
    Route::get('examCoordinator/dashboard', [ExamCoordinatorController::class, 'dashboard'])->name('examCoordinator.dashboard');
    Route::resource('examManagement', ExamManagementController::class);
    Route::resource('questionManagement', QuestionController::class);
    Route::resource('answerChoiceManagement', AnswerChoiceController::class);
    Route::resource('studentManagement', StudentC::class);
    Route::resource('profileManagement', ProfileC::class);
    Route::resource('invigilatorManagement', InvigilatorController::class);
    Route::resource('cheatM', CheatMController::class);
    Route::post('examCoordinator/student/storebulk', [StudentC::class, 'storebulk'])->name('examCoordinator.student.storebulk');;
});

// student
Route::middleware(['auth', 'role:student'])->group(function () {
    // Routes accessible to users with the 'admin' role
    // Route::get('student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('student/upcomingexam/index', [UpcomingExamController::class, 'index'])->name('student.upcomingexam.index');
    Route::get('student/upcomingexam/create', [UpcomingExamController::class, 'create'])->name('student.upcomingexam.create');
    Route::post('student/upcomingexam/store', [UpcomingExamController::class, 'store'])->name('student.upcomingexam.store');
    Route::get('student/upcomingexam/submit', [UpcomingExamController::class, 'submit'])->name('student.upcomingexam.submit');
    Route::get('student/upcomingexam/show/{id}', [UpcomingExamController::class, 'show'])->name('student.upcomingexam.show');
    Route::get('student/upcomingexam/finish/{id}', [UpcomingExamController::class, 'finish'])->name('student.upcomingexam.finish');
    Route::post('student/upcomingexam/validateExamPassword', [UpcomingExamController::class, 'validateExamPassword'])->name('student.validateExamPassword');


    // Route::get('student/profile/index', [StudentProfileController::class, 'index'])->name('student.profile.index');
    // finish
    Route::get('student/takenexam/index', [TakenExamController::class, 'index'])->name('student.takenexam.index');
    Route::get('student/takenexam/show/{id}', [TakenExamController::class, 'show'])->name('student.takenexam.show');

    //
});

//Route::middleware(['auth', 'role:admin'])->group(function(){
// Routes accessble to users with admin role
//Route::get('admin/college/form', [CollegeController::class, 'addCollege'])->name('collegeForm');
//});
Route::get('admin/college/form', [CollegeController::class, 'collegeForm'])->name('collegeForm');
Route::post('admin/college/save', [CollegeController::class, 'storeCollege'])->name('storeCollege');
Route::get('admin/college/list', [CollegeController::class, 'collegeList'])->name('collegeList');
Route::get('admin/college/detail', [CollegeController::class, 'collegeDetail'])->name('collegeDetail');
Route::get('admin/college/detail/{id}', [CollegeController::class, 'collegeDetail'])->name('college.detail');
Route::get('admin/college/edit/{id}', [CollegeController::class, 'collegeEdit'])->name('college.edit');
Route::put('admin/college/edit/{id}', [CollegeController::class, 'collegeUpdate'])->name('college.update');
Route::delete('admin/college/delete/{id}', [CollegeController::class, 'destroyCollege'])->name('college.delete');
Route::get('admin/college/search', [CollegeController::class, 'searchColleges'])->name('college.search');










//Department
//Route::get('admin/examCoordinator/form', [ExamCoordinatorController::class, 'departmentForm'])->name('departmentForm');
Route::post('admin/examCoordinator/save', [ExamCoordinatorController::class, 'storeCoordinator'])->name('storeCoordinator');
Route::get('admin/coordinator/form', [ExamCoordinatorController::class, 'coordinatorForm'])->name('coordinatorForm');
Route::get('admin/examCoordinator/list', [ExamCoordinatorController::class, 'examCoordinatorList'])->name('examCoordinatorList');
Route::get('admin/examCoordinator/detail', [ExamCoordinatorController::class, 'examCoordinatorDetail'])->name('examCoordinatorDetail');
Route::get('admin/examCoordinator/detail/{id}', [ExamCoordinatorController::class, 'examCoordinatorDetail'])->name('examCoordinator.detail');
Route::get('admin/examCoordinator/edit/{id}', [ExamCoordinatorController::class, 'examCoordinatorEdit'])->name('examCoordinator.edit');
Route::put('admin/examCoordinator/edit/{id}', [ExamCoordinatorController::class, 'examCoordinatorUpdate'])->name('examCoordinator.update');
Route::delete('admin/examCoordinator/delete/{id}', [ExamCoordinatorController::class, 'destroyExamCoordinator'])->name('examCoordinator.delete');
Route::get('admin/examCoordinator/search', [ExamCoordinatorController::class, 'searcExamCoordinator'])->name('examCoordinator.search');





//Department Routes
Route::get('admin/department/form', [DepartmentController::class, 'departmentForm'])->name('departmentForm');
Route::get('admin/department/list', [DepartmentController::class, 'departmentList'])->name('departmentList');
Route::get('admin/department/detail', [DepartmentController::class, 'departmentDetail'])->name('departmentDetail');
Route::get('admin/department/detail/{id}', [DepartmentController::class, 'departmentDetail'])->name('department.detail');
Route::get('admin/department/edit/{id}', [DepartmentController::class, 'departmentEdit'])->name('department.edit');
Route::put('admin/department/edit/{id}', [DepartmentController::class, 'departmentUpdate'])->name('department.update');
Route::delete('admin/department/delete/{id}', [DepartmentController::class, 'destroyDepartment'])->name('department.delete');
Route::get('admin/department/search', [DepartmentController::class, 'searchDepartment'])->name('department.search');




Route::get('admin/Schedule/home', [ScheduleController::class, 'examList'])->name('examList');
Route::get('admin/Schedule/create/{examSetupId}', [ScheduleController::class, 'showExamSetup'])->name('createSchedule');
Route::post('admin/Schedule/create', [ScheduleController::class, 'setSchedule'])->name('setSchedule');
Route::get('admin/Schedule/edit/{schedule_id}', [ScheduleController::class, 'edit'])->name('editSchedule');
Route::put('admin/Schedule/update/{id}', [ScheduleController::class, 'update'])->name('updateSchedule');
Route::get('admin/Schedule/delete/{id}', [ScheduleController::class, 'delete'])->name('deleteSchedule');

//Route::post('/exam-setups/{examSetupId}', 'ScheduleController@showExamSetup')->name('createSchedule');

Route::middleware(['auth', 'role:invigilator'])->group(function () {
    // Routes accessible to users with the 'admin' role
    // Route::get('student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('invigilator/assigned/index', [AssignedExamController::class, 'index'])->name('invigilator.assigned.index');
    Route::get('invigilator/assigned/show/{id}', [AssignedExamController::class, 'show'])->name('invigilator.assigned.show');
    Route::post('invigilator/updatestatus', [AssignedExamController::class, 'updatestatus'])->name('invigilator.updatestatus');

    // Route::get('invigilator/cheatreport/index', [CheatReportController::class, 'index'])->name('invigilator.cheatreport.index');
    // Route::get('invigilator/cheatreport/index', [CheatReportController::class, 'index'])->name('invigilator.cheatreport.create');
    // Route::get('invigilator/cheatreport/index', [CheatReportController::class, 'index'])->name('invigilator.cheatreport.store');
    Route::resource('cheatManagement', CheatReportController::class);


    // updateStatus

    //
});


require __DIR__ . '/auth.php';
