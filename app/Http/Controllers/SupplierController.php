<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Image;
use DB;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier=Supplier::all();
        return response()->json($supplier);
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:suppliers|max:255',
            'email' => 'required',
            'address' => 'required',
            'shop_name' => 'required',
           ]);

           if($request->photo){
            $position = strpos($request->photo, ';');
            $sub=substr($request->photo, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($request->photo)->resize(240,200);
            $upload_path='backend/supplier/';
            $image_url=$upload_path.$name;
            $img->save($image_url);

            $employee = new Supplier;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->phone = $request->phone;
            $employee->shop_name = $request->shop_name;
            $employee->photo =  $image_url;
            $employee->save();

        }else{
            $employee = new Supplier;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->phone = $request->phone;
            $employee->shop_name = $request->shop_name;
            $employee->save();
        }
    }

    
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    
    public function update(Request $request,$id)
    {
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shop_name']=$request->shop_name;
        $image=$request->newphoto;
        if ($image) {
            $position = strpos($image, ';');
            $sub=substr($image, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($image)->resize(240,200);
            $upload_path='backend/supplier/';
            $image_url=$upload_path.$name;
            $success=$img->save($image_url);
        if  ($success) {
              $data['photo']=$image_url;
              $img=DB::table('suppliers')->where('id',$id)->first();
              $image_path = $img->photo;
              $done=unlink($image_path);
              $user=DB::table('suppliers')->where('id',$id)->update($data); 
            }
        }else{
            $oldlogo=$request->photo;       
            $data['photo']=$oldlogo;  
            DB::table('suppliers')->where('id',$id)->update($data); 
        }
    }

    
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $photo=$supplier->photo;
        if($photo){
            unlink($photo);
            $supplier->delete();
        }else{
            $supplier->delete();
        }
    }
}
