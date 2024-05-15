<?php


namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\College;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function departmentForm(Request $request)
    {
        $college = College::all();
        return view('admin.department.departmentForm', compact('college'));
    }


    public function storeDepartment(Request $request)
    {
        $department = new Department;
        $department->department_name = $request->input('department_name');
        $department->department_abbrivation = $request->input('department_abbreviation');
        $department->college_name = $request->input('college_name');

        $department->save();
        return redirect()->route('admin.dashboard');
    }


    function departmentList(){
        $list = department::all();

        return view('admin.department.departmentList', compact('list'));
    }

    function departmentDetail(string $id){
        $department = Department::findOrFail($id);
        //$examSetupId = $student->exam_setup_id;
        return view('admin.department.departmentdetail',compact('department'));

    }
    function departmentEdit(string $id){
        $department = Department::findOrFail($id);
        //$examSetupId = $student->exam_setup_id;
        return view('admin.department.departmentedit',compact('department'));

    }
    function departmentUpdate(Request $request, string $id)
    {
    $department = Department::findOrFail($id);

    $request->validate([
        'department_name' => 'required|string',
        'department_abbrivation' => 'required|string',
    ]);

    $department->department_name = $request->input('department_name');
    $department->department_abbrivation = $request->input('department_abbrivation');
    $department->save();

    return redirect()->route('department.detail', $department->id);
    }

    public function destroyDepartment(string $id)
{
    $department = Department::findOrFail($id);
    $department->delete();

    return redirect()->route('departmentList', $department->id)->with('success', 'Department deleted successfully.');
}

    public function searchDepartment(Request $request)
    {
        $searchValue = $request->input('search');

        $department = Department::where('department_name', 'LIKE', '%'.$searchValue.'%')->get();



        return view('admin.department.departmentList', ['list' => $department]);
    }
}
