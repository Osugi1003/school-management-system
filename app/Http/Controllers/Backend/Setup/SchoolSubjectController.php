<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\SchoolSubjects; 

class SchoolSubjectController extends Controller
{
      public function ViewSubject(){
    	$data['allData'] = SchoolSubjects::all();
    	return view('backend.setup.school_subject.view_school_subject',$data);
 
    }


	public function SubjectAdd(){
    	return view('backend.setup.school_subject.add_school_subject');
    }

    public function SubjectStore(Request $request){

	    	$validatedData = $request->validate([
	    		'name' => 'required|unique:school_subjects,name',
	    		
	    	]);

	    	$data = new SchoolSubjects();
	    	$data->name = $request->name;
	    	$data->save();

	    	$notification = array(
	    		'message' => 'Subject Inserted Successfully',
	    		'alert-type' => 'success'
	    	);

	    return redirect()->route('school.subject.view')->with($notification);

	    }


	    public function SubjectEdit($id){
	    	$editData = SchoolSubjects::find($id);
	    	return view('backend.setup.school_subject.edit_school_subject',compact('editData'));
	    }



	    public function SubjectUpdate(Request $request,$id){

	 $data = SchoolSubjects::find($id);
     
     $validatedData = $request->validate([
    		'name' => 'required|unique:school_subjects,name,'.$data->id
    		
    	]);

    	
    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'Subject Updated Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('school.subject.view')->with($notification);
    }


     public function SubjectDelete($id){
	    	$user = SchoolSubjects::find($id);
	    	$user->delete();

	    	$notification = array(
	    		'message' => 'Subject Deleted Successfully',
	    		'alert-type' => 'info'
	    	);

	   return redirect()->route('school.subject.view')->with($notification);

	    }




} 
