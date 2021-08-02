<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use DB;
use Image;

class CustomerController extends Controller
{
    
    public function index()
    {
        $customer=Customer::orderBy('id', 'DESC')->get();
        return response()->json($customer);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:customers|max:255',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
           ]);

           if($request->photo){
            $position = strpos($request->photo, ';');
            $sub=substr($request->photo, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($request->photo)->resize(240,200);
            $upload_path='backend/customer/';
            $image_url=$upload_path.$name;
            $img->save($image_url);

            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->photo =  $image_url;
            $customer->save();

        }else{
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->save();
        }
    }

    
    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
           ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $image=$request->newphoto;
        if ($image) {
            $position = strpos($image, ';');
            $sub=substr($image, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($image)->resize(240,200);
            $upload_path='backend/customer/';
            $image_url=$upload_path.$name;
            $success=$img->save($image_url);
        if  ($success) {
              $data['photo']=$image_url;
              $img=DB::table('customers')->where('id',$id)->first();
              $image_path = $img->photo;
              $done=unlink($image_path);
              $user=DB::table('customers')->where('id',$id)->update($data); 
            }
        }else{
            $oldlogo=$request->photo;       
            $data['photo']=$oldlogo;  
            DB::table('customers')->where('id',$id)->update($data); 
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $photo=$customer->photo;
        if($photo){
            unlink($photo);
            $customer->delete();
        }else{
            $customer->delete();
        }
    }
}
