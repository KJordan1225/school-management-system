<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    public function ViewFeeCategory(){
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_cat', $data);
    }

    public function FeeCategoryAdd(){
        return view('backend.setup.fee_category.add_fee_cat');
    }

    public function FeeCategoryStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student fee category inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);

    }

    public function FeeCategoryEdit($id){
        $editData = FeeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee_cat', compact('editData'));

        // $data['editData'] = FeeCategory::find($id);
        // return view('backend.setup.fee_category.edit_fee_cat', $data);
    }

    public function FeeCategoryUpdate(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name,'.$id,
        ]);

        $data = FeeCategory::find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student fee category updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('fee.category.view')->with($notification);
    }

    public function FeeCategoryDelete($id){


        $data = FeeCategory::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Student fee category deleted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('fee.category.view')->with($notification);
    }
}
