<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryFee;

class FeeCategoryController extends Controller
{
    public function ViewFeeCat(){
        $data['allData'] = CategoryFee::all();
        return view('backend.setup.fee_category.view_fee_cat',$data);
       }

       public function FeeCatAdd(){
        return view('backend.setup.fee_category.add_fee_cat');
       }

       public function FeeCatStore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:category_fees,name',
        ]);

        $data = new CategoryFee();
        $data->name = $request->name;
        $data->save();    

        $notification = array(
            'message' => 'Fee Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);

    }

    public function FeeCatEdit($id){
        $editData = CategoryFee::find($id);
        return view('backend.setup.fee_category.edit_fee_cat',compact('editData'));
    }

    public function FeeCatUpdate(Request $request,$id){

        $data =  CategoryFee::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:category_fees,name,'.$data->id
        ]);

        
        $data->name = $request->name;
        $data->save();    

        $notification = array(
            'message' => 'Fee Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }

    public function FeeCatDelete($id){
        $user = CategoryFee::find($id);
        $user->delete();

        $notification = array(
            'message' => 'Fee Category Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }
}
