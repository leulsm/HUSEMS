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
}
