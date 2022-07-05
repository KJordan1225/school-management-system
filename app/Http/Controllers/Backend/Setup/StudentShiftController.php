<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function ViewShift(){
        $data['allData'] = StudentShift::all();
        return view('backend.setup.student_shift.view_shift', $data);
    }

    public function StudentShiftAdd(){
        return view('backend.setup.student_shift.add_shift');
    }

    public function StudentShiftStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
        ]);

        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student shift inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.view')->with($notification);

    }

    public function StudentShiftEdit($id){
        $editData = StudentShift::find($id);
        return view('backend.setup.student_shift.edit_shift', compact('editData'));

        // $data['editData'] = StudentShift::find($id);
        // return view('backend.setup.student_shift.edit_shift', $data);
    }

    public function StudentShiftUpdate(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$id,
        ]);

        $data = StudentShift::find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student shift updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('student.shift.view')->with($notification);
    }

    public function StudentShiftDelete($id){


        $data = StudentShift::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Student shift deleted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('student.shift.view')->with($notification);
    }
}
