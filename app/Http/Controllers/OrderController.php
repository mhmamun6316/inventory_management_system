<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class OrderController extends Controller
{
    public function TodayOrder()
    {
    	$data=date('d/m/Y');
    	$order=DB::table('orders')
    	      ->join('customers','orders.customer_id','customers.id')
    	      ->where('orders.order_date',$data)
    	      ->select('customers.name','orders.*')
    	      ->orderBy('orders.id','DESC')->get();
    	return response()->json($order);
    }

    public function OrderDetails($id)
    {
    	$orders=DB::table('orders')
    	        ->join('customers','orders.customer_id','customers.id')
    	        ->where('orders.id',$id)
    	        ->select('customers.name','customers.phone','customers.address','orders.*')
    	        ->first();
    	  return response()->json($orders);               
    }

    public function OrderDetailsAll($id)
    {
    	$details=DB::table('order_details')
    	          ->join('products','order_details.product_id','products.id')
    	          ->where('order_details.order_id',$id)
    	          ->select('products.Product_name','products.image','order_details.*')
    	          ->get();
    	  return response()->json($details); 
    }

    public function SearchOrderDate(Request $request){
    	$orderdate=$request->date;
        $newdate=new DateTime($orderdate);
        $done=$newdate->format('d/m/Y');

        $order=DB::table('orders')
            ->join('customers','orders.customer_id','customers.id')
            ->select('customers.name','orders.*')
            ->where('orders.order_date',$done)
            ->get();
    	return response()->json($order);
    }

    //Monthwise All Total
    public function TotalMonthSale(request $request){
    	$month=date('F');
        $total=DB::table('orders')->where('order_month',$month)->sum('total');
    	return response()->json($total);
    }

    public function TotalMonthPay(request $request){
    	$month=date('F');
        $total=DB::table('orders')->where('order_month',$month)->sum('pay');
    	return response()->json($total);
    }

    public function TotalMonthDue(request $request){
    	$month=date('F');
        $total=DB::table('orders')->where('order_month',$month)->sum('due');
    	return response()->json($total);
    }

    public function TotalMonthExpense(request $request){
    	$month=date('F');
        $total=DB::table('expenses')->where('expense_month',$month)->sum('amount');
    	return response()->json($total);
    }



    //Day Wise Total
    public function TodaySale(){
        $date=date('d/m/Y');
        $total=DB::table('orders')->where('order_date',$date)->sum('total');
        return response()->json($total);
    }

    public function TodayIncome(){
        $date=date('d/m/Y');
        $total=DB::table('orders')->where('order_date',$date)->sum('pay');
        return response()->json($total);
    }

    public function TodayDue(){
        $date=date('d/m/Y');
        $total=DB::table('orders')->where('order_date',$date)->sum('due');
        return response()->json($total);
    }

    public function TodayExpense(){
        $date=date('d/m/Y');
        $total=DB::table('expenses')->where('expense_date',$date)->sum('amount');
        return response()->json($total);
    }

    public function Stockout(){
        $stocks=DB::table('products')->where('product_quantity','<','1')->get();
        return response()->json($stocks);
    }
    
}
