<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        // pass allData Object to view_user via $data.
        $data['allData'] = User::all();
        return view('backend.user.view_user', $data);
    }

    public function UserAdd(){
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);

        $data = new User();
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        $notification = array(
            'message' => 'User inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);

    }

    public function UserEdit($id){
        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));
    }

    public function UserUpdate(Request $request, $id){

        $validatedData = $request->validate([
            'email' => 'required|unique:users,email,'.$id,
            'name' => 'required',
        ]);

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->usertype = $request->usertype;
        $data->save();

        $notification = array(
            'message' => 'User updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('user.view')->with($notification);
    }

    public function UserDelete($id){


        $data = User::find($id);
        $data->delete();

        $notification = array(
            'message' => 'User deleted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('user.view')->with($notification);
    }
}
