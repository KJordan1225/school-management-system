<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function ViewGroup(){
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.student_group.view_group', $data);
    }

    public function StudentGroupAdd(){
        return view('backend.setup.student_group.add_group');
    }

    public function StudentGroupStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);

        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student group inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);

    }

    public function StudentGroupEdit($id){
        $editData = StudentGroup::find($id);
        return view('backend.setup.student_group.edit_group', compact('editData'));

        // $data['editData'] = StudentGroup::find($id);
        // return view('backend.setup.student_group.edit_group', $data);
    }

    public function StudentGroupUpdate(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name,'.$id,
        ]);

        $data = StudentGroup::find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student year updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('student.group.view')->with($notification);
    }

    public function StudentGroupDelete($id){


        $data = StudentGroup::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Student group deleted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('student.group.view')->with($notification);
    }
}
