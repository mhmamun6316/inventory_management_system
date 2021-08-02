<?php

namespace App\Http\Controllers;

use App\Employe;
use Illuminate\Http\Request;
use Image;
use DB;

class EmployeController extends Controller
{
    
    public function index()
    {
        $employee=Employe::all();
        return response()->json($employee);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:employes|max:255',
            'email' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'nid' => 'required',
           ]);

           if($request->photo){
            $position = strpos($request->photo, ';');
            $sub=substr($request->photo, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($request->photo)->resize(240,200);
            $upload_path='backend/employee/';
            $image_url=$upload_path.$name;
            $img->save($image_url);

            $employee = new Employe;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->joining_date = $request->joining_date;
            $employee->nid = $request->nid;
            $employee->photo =  $image_url;
            $employee->save();

        }else{
            $employee = new Employe;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->joining_date = $request->joining_date;
            $employee->nid = $request->nid;
            $employee->save();
        }
    }

    
    public function show($id)
    {
        $employeee = Employe::find($id);
        return response()->json($employeee);
    }


    public function update(Request $request,$id)
    {
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['salary']=$request->salary;
        $data['address']=$request->address;
        $data['nid']=$request->nid;
        $data['joining_date']=$request->joining_date;
        $image=$request->newphoto;
        if ($image) {
            $position = strpos($image, ';');
            $sub=substr($image, 0 ,$position);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($image)->resize(240,200);
            $upload_path='backend/employee/';
            $image_url=$upload_path.$name;
            $success=$img->save($image_url);
        if  ($success) {
              $data['photo']=$image_url;
              $img=DB::table('employes')->where('id',$id)->first();
              $image_path = $img->photo;
              $done=unlink($image_path);
              $user=DB::table('employes')->where('id',$id)->update($data); 
            }
        }else{
            $oldlogo=$request->photo;       
            $data['photo']=$oldlogo;  
            DB::table('employes')->where('id',$id)->update($data); 
        }
    }

    public function destroy($id)
    {
        $post = Employe::find($id);
        $photo=$post->photo;
        if($photo){
            unlink($photo);
            $post->delete();
        }else{
            $post->delete();
        }
    }
}
