<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use DB;

class ExpenseController extends Controller
{
    
    public function index()
    {
        $expense=Expense::all();
        return response()->json($expense);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'details' => 'required',
           ]);
        
        $expense = new Expense;
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->expense_month = date('F');
        $expense->expense_date = date('d/m/Y');
        $expense->save();
    }

    
    public function show($id)
    {
        $expense=Expense::find($id);
        return response()->json($expense);
    }

    
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'details' => 'required',
           ]);

           $data=array();
           $data['details']=$request->details;
           $data['amount']=$request->amount;
           DB::table('expenses')->where('id',$id)->update($data);
    }

    
    public function destroy($id)
    {
        $expense=Expense::find($id);
        $expense->delete();
    }
}
