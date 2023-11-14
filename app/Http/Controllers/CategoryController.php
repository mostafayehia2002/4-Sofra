<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function  index(){
      $categories=  Category::all();
        return view('categories.index',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:categories,name',
        ]);
        Category::create($request->only('name'));

        return redirect()->back()->with('success','Successfully Added Category');
    }

    public  function update(Request $request){
        $request->validate([
            'name'=>'required|unique:categories,name,'.$request->id,
        ]);
        $category=Category::findOrFail($request->id);
        $category->update([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Successfully Update Category');

    }

    public function delete($id){
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success','Successfully Deleted Category');
    }

}
