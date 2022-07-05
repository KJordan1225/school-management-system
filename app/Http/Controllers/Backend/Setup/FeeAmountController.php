<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;

class FeeAmountController extends Controller
{
    public function ViewFeeAmount(){
        $data['allData'] = FeeCategoryAmount::all();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }

    public function FeeAmountAdd(){
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }

    public function FeeAmountStore(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name',
        ]);

        $data = new FeeAmount();
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student fee category inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);

    }

    public function FeeAmountEdit($id){
        $editData = FeeAmount::find($id);
        return view('backend.setup.fee_category.edit_fee_cat', compact('editData'));

        // $data['editData'] = FeeAmount::find($id);
        // return view('backend.setup.fee_category.edit_fee_cat', $data);
    }

    public function FeeAmountUpdate(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name,'.$id,
        ]);

        $data = FeeAmount::find($id);
        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'Student fee category updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('fee.category.view')->with($notification);
    }

    public function FeeAmountDelete($id){


        $data = FeeAmount::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Student fee category deleted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('fee.category.view')->with($notification);
    }
}
