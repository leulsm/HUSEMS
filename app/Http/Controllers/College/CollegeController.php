<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Models\College;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    function collegeForm(){
        return view('admin.college.collegeForm');
    }

    function storeCollege(Request $request){
        $college = new College;
        $college->id= $request->input('college_id');
        $college->college_name = $request->input('college_name');
        $college->college_abbrivation = $request->input('college_abbrivation');
        $college->save();

        return redirect()->route('collegeList')->with('success', 'College added successfully.');
    }
    function collegeList(){
        $list = college::all();

        return view('admin.college.collegeList', compact('list'));
    }
    function collegeDetail(string $id){
        $college = College::findOrFail($id);
        //$examSetupId = $student->exam_setup_id;
        return view('admin.college.collegedetail',compact('college'));

    }
    function collegeEdit(string $id){
        $college = College::findOrFail($id);
        //$examSetupId = $student->exam_setup_id;
        return view('admin.college.collegeedit',compact('college'));

    }
    function collegeUpdate(Request $request, string $id)
    {
    $college = College::findOrFail($id);

    $request->validate([
        'college_name' => 'required|string',
        'college_abbrivation' => 'required|string',
    ]);

    $college->college_name = $request->input('college_name');
    $college->college_abbrivation = $request->input('college_abbrivation');
    $college->save();

    return redirect()->route('college.detail', $college->id);
    }

    public function destroyCollege(string $id)
{
    $college = College::findOrFail($id);
    $college->delete();

    return redirect()->route('collegeList', $college->id)->with('success', 'College deleted successfully.');
}

    public function searchColleges(Request $request)
    {
        $searchValue = $request->input('search');

        $colleges = College::where('college_name', 'LIKE', '%'.$searchValue.'%')->get();



        return view('admin.college.collegeList', ['list' => $colleges]);
    }
}
