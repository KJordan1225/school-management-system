<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function ViewYear(){
        $data['allData'] = StudentYear::all();
        return view('backend.setup.student_year.view_year', $data);
    }

    public function StudentYearAdd(){
        return view('backend.setup.student_year.add_year');
    }

    public function StudentYearStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);

        $data = new StudentYear();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student year inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);

    }

    public function StudentYearEdit($id){
        $editData = StudentYear::find($id);
        return view('backend.setup.student_year.edit_year', compact('editData'));

        // $data['editData'] = StudentYear::find($id);
        // return view('backend.setup.student_year.edit_year', $data);
    }

    public function StudentYearUpdate(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$id,
        ]);

        $data = StudentYear::find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student year updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('student.year.view')->with($notification);
    }

    public function StudentYearDelete($id){


        $data = StudentYear::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Student year deleted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('student.year.view')->with($notification);
    }
}
