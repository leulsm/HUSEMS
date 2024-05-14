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
use App\Http\Controllers\Schedule\ScheduleController;



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

Route::get('admin/department/form', [DepartmentController::class, 'departmentForm'])->name('departmentForm');


Route::get('admin/coordinator/form', [ExamCoordinatorController::class, 'coordinatorForm'])->name('coordinatorForm');
Route::post('admin/department/save', [ExamCoordinatorController::class, 'storeCoordinator'])->name('storeCoordinator');


Route::get('admin/Schedule/home', [ScheduleController::class, 'examList'])->name('examList');
Route::get('admin/Schedule/create/{examSetupId}', [ScheduleController::class, 'showExamSetup'])->name('createSchedule');
Route::post('admin/Schedule/create', [ScheduleController::class, 'setSchedule'])->name('setSchedule');
Route::get('admin/Schedule/edit/{schedule_id}', [ScheduleController::class, 'edit'])->name('editSchedule');
Route::put('admin/Schedule/update/{id}', [ScheduleController::class, 'update'])->name('updateSchedule');
Route::get('admin/Schedule/delete/{id}', [ScheduleController::class, 'delete'])->name('deleteSchedule');

//Route::post('/exam-setups/{examSetupId}', 'ScheduleController@showExamSetup')->name('createSchedule');




require __DIR__ . '/auth.php';
