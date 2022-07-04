<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function ProfileView(){
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('backend.user.view_profile', compact('user'));

    }

    public function ProfileEdit(){
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('backend.user.edit_profile', compact('editData'));
    }

    public function ProfileStore(Request $request){        

        $id = Auth::user()->id;
        $editData = User::find($id);
        $editData->name = $request->name;
        $editData->email = $request->email;
        $editData->usertype = $request->usertype;
        $editData->mobile = $request->mobile;
        $editData->address = $request->address;
        $editData->gender = $request->gender;

        if ($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('uplaod/user_images/'.$editData->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $editData['image'] = $filename;
        } 

        $editData->save();

        $notification = array(
            'message' => 'User profile updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('profile.view')->with($notification);

    } // End method

    public function PasswordView(){
        return view('backend.user.edit_password');
    }

    public function PasswordUpdate(Request $request){

        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->back()->with('error','Current password does not match our records');
        }

    } // End method
}
