<?php

namespace App\Http\Controllers;

use App\Product;
use App\category;
use App\Supplier;
use Illuminate\Http\Request;
use Image;
use DB;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with('Supplier','Category')->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'supplier_id' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
           ]);

           if($request->image){
            $position = strpos($request->image, ';');
            $sub=substr($request->image, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($request->image)->resize(240,200);
            $upload_path='backend/product/';
            $image_url=$upload_path.$name;
            $img->save($image_url);

            $product = new Product;
            $product->Product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->supplier_id = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->image =  $image_url;
            $product->save();

        }else{
            $product = new Product;
            $product->Product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->supplier_id = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->image =  $image_url;
            $product->save();
        }
    }

   
    public function show($id)
    {
        $products=Product::find($id);
        return response()->json($products);
    }

    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'Product_name' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'supplier_id' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
           ]);

        $data=array();
        $data['Product_name']=$request->Product_name;
        $data['category_id']=$request->category_id;
        $data['supplier_id']=$request->supplier_id;
        $data['root']=$request->root;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;
        $data['buying_date']=$request->buying_date;
        $data['product_quantity']=$request->product_quantity;
        $image=$request->newphoto;
        if ($image) {
            $position = strpos($image, ';');
            $sub=substr($image, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($image)->resize(240,200);
            $upload_path='backend/product/';
            $image_url=$upload_path.$name;
            $success=$img->save($image_url);
        if  ($success) {
                $data['image']=$image_url;
                $img=DB::table('products')->where('id',$id)->first();
                $image_path = $img->image;
                $done=unlink($image_path);
                $user=DB::table('products')->where('id',$id)->update($data);  
            }
        }else{
            $oldlogo=$request->image;       
            $data['image']=$oldlogo;  
            DB::table('products')->where('id',$id)->update($data); 
        }
    }

    
    public function destroy($id)
    {
        $product=Product::find($id);
        $photo=$product->image;
        if($photo){
            unlink($photo);
            $product->delete();
        }else{
            $product->delete();
        }
    }
}
