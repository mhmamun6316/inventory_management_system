<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    
    public function index()
    {
        $salary=Salary::select('salary_month')->groupBy('salary_month')->get();
        // $salary=DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();
    	return response()->json($salary);
    }

    
    public function store(Request $request)
    {
        
    }

    
    public function show($id)
    {
        $month=$id;
        $view = Salary::with('Employe:id,name')
        ->where('salaries.salary_month',$month)
        ->get();
    	// $view=DB::table('salaries')
	    // 	->join('employes','salaries.employee_id','employes.id')
	    // 	->select('employes.name','salaries.*')
	    // 	->where('salaries.salary_month',$month)
	    // 	->get();
	    return response()->json($view);
    }

    
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'salary_month' => 'required',
           ]);
   
           $month=$request->salary_month;
   
           $check=DB::table('salaries')->where('employee_id',$id)->where('salary_month',$month)->first();
           if ($check) {
               return response()->json('salary already paid');
           }else{
                $data=array();
                $data['employee_id']=$id;
                $data['amount']=$request->salary;
                $data['salary_date']=date('d/m/Y');
                $data['salary_month']=$month;
                $data['salary_year']=date('Y');
                DB::table('salaries')->insert($data);
            }
    }

    
    public function destroy(Salary $salary)
    {
        //
    }
}
