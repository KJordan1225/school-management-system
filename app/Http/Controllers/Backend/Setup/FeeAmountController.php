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
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }

    public function FeeAmountAdd(){
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }

    public function FeeAmountStore(Request $request){

        $countClass = count($request->class_id);
        if ($countClass != NULL){
            for ($i=0; $i<$countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            }// End for loop
        } // End if condition

        $notification = array(
            'message' => 'Student fee amount inserted successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('fee.amount.view')->with($notification);        

    }

    public function FeeAmountEdit($fee_category_id){
        // $editData = FeeCategoryAmount::find($fee_category_id);
        // return view('backend.setup.fee_category.edit_fee_cat', compact('editData'));

        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        // dd($data['editData']->toArray());
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    public function FeeAmountUpdate(Request $request, $fee_category_id){
        if($request->class_id == NULL){
            return back()->with('error', 'At least one Class and Amount is required for update');
        } else {
            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();    
            for ($i=0; $i<$countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            }// End for loop               

        }        

        $notification = array(
            'message' => 'Student fee amount updated successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('fee.amount.view')->with($notification);
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
