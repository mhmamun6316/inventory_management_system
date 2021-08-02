<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use Image;
use DB;

class CategoryController extends Controller
{
    
    public function index()
    {
        $category=category::all();
        return response()->json($category);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'categories_name' => 'required|unique:categories|max:255',
           ]);
        
        $category = new category;
        $category->categories_name = $request->categories_name;
        $category->save();
    }

    
    public function show($id)
    {
        $category=category::find($id);
        return response()->json($category);
    }
    public function update(Request $request,$id)
    {
        $data=array();
        $data['categories_name']=$request->categories_name;
        DB::table('categories')->where('id',$id)->update($data); 
    }

    public function destroy($id)
    {
        $category=category::find($id);
        $category->delete();
    }
}
