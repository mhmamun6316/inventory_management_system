<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PosController extends Controller
{
    public function GetProduct($id)
    {
    	$product=DB::table('products')
                ->where('category_id',$id)
                ->get();
        return response()->json($product);
    }

    public function AddTocart(Request $request,$id){

        $product=DB::table('products')->where('id',$id)->first();

    	$check=DB::table('pos')->where('product_id',$id)->first();

    	if ($check) {
    		$increment=DB::table('pos')->where('product_id',$id)->increment('product_quantity');
            $pos=DB::table('pos')->where('product_id',$id)->first();
            $subtotal=$pos->product_quantity * $pos->product_price;
            DB::table('pos')->where('product_id',$id)->update(['sub_total' => $subtotal]);
    	}else{
    		$data=array();
	    	$data['product_id']=$id;
	    	$data['product_name']=$product->Product_name;
	    	$data['product_quantity']=1;
	    	$data['product_price']=$product->selling_price;
	    	$data['sub_total']=$product->selling_price;
	    	DB::table('pos')->insert($data);
    	}
    	return response()->json('done');
    }

    public function AllCart(){
        $cart=DB::table('pos')->get();
    	return response()->json($cart);
    }

    public function RemoveCart($id){
    	DB::table('pos')->where('id',$id)->delete();
    	return response('done');
    }

    public function Increment($id)
    {
    	$quantity=DB::table('pos')->where('id',$id)->increment('product_quantity');
    	$product=DB::table('pos')->where('id',$id)->first();
    	$subtotal=$product->product_quantity * $product->product_price;
    	DB::table('pos')->where('id',$id)->update(['sub_total' => $subtotal]);
    	return response('done');
    }

    public function decrement($id)
    {
    	$quantity=DB::table('pos')->where('id',$id)->decrement('product_quantity');
    	$product=DB::table('pos')->where('id',$id)->first();
    	$subtotal=$product->product_quantity * $product->product_price;
    	DB::table('pos')->where('id',$id)->update(['sub_total' => $subtotal]);
    	return response('done');
    }

    public function Vat(){
        $vat=DB::table('vats')->first();
        return response()->json($vat);
    }

    public function OrderDone(Request $request){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'payby' => 'required',
          ]);
 
          $data=array();
          $data['customer_id']=$request->customer_id;
          $data['qty']=$request->qty;
          $data['sub_total']=$request->subtotal;
          $data['vat']=$request->vat;
          $data['total']=$request->total;
          $data['payby']=$request->payby;
          $data['pay']=$request->pay;
          $data['due']=$request->due;
          $data['order_date']=date('d/m/Y');
          $data['order_month']=date('F');
          $data['order_year']=date('d/m/Y');
          $order_id=DB::table('orders')->insertGetId($data);
 
          $contents=DB::table('pos')->get();
 
          $odata=array();
          foreach ($contents as $content) {
              $odata['order_id']=$order_id;
              $odata['product_id']=$content->product_id;
              $odata['pro_quantity']=$content->product_quantity;
              $odata['product_price']=$content->product_price;
              $odata['sub_total']=$content->sub_total;
              DB::table('order_details')->insert($odata);	
 
             DB::table('products')
                  ->where('id',$content->product_id)
                  ->update(['product_quantity' => DB::raw('product_quantity -' .$content->product_quantity)]);
          }
 
          DB::table('pos')->delete();
          return response('done');
    }
}
