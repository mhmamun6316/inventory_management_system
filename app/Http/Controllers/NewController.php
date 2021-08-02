<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NewController extends Controller
{
    public function EditSalary($id){
        $view=DB::table('salaries')
	    	->join('employes','salaries.employee_id','employes.id')
	    	->select('employes.name','employes.email','salaries.*')
	    	->where('salaries.id',$id)
	    	->first();
	    return response()->json($view);	
    }

    public function UpdateSalary(Request $request,$id){
        
        $data=array();
        $data['employee_id']=$request->employee_id;
        $data['amount']=$request->amount;
        $data['salary_month']=$request->salary_month;
        DB::table('salaries')->where('id',$id)->update($data);
    }

    public function UpdateStock(Request $request,$id){
           $validatedData = $request->validate([
            'product_quantity' => 'required',
           ]);

            $data=array();
            $data['product_quantity']=$request->product_quantity;
            DB::table('products')->where('id',$id)->update($data);
    }
}
