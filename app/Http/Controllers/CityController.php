<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function  index(){
      $cities=City::with('regions')->get();
        return view('cities.index',compact('cities'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:cities,name',
        ]);
        City::create($request->only('name'));
        return redirect()->back()->with('success','Successfully Added City');
    }

    public  function update(Request $request){
        $request->validate([
            'name'=>'required|unique:cities,name,'.$request->id,
        ]);
        $city=City::findOrFail($request->id);
        $city->update([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Successfully Update City');

    }

    public function delete($id){
        $city=City::findOrFail($id);
        $city->delete();
        return redirect()->back()->with('success','Successfully Deleted City');
    }



}
