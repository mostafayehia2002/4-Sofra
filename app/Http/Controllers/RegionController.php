<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index($id){
        $city=City::with('regions')->where('id',$id)->first();
        return view('cities.region',compact('city'));
    }
    public function store(Request $request){
        $request->validate([
            'region'=>'required|unique:regions,name',
        ]);
        Region::create([
            'name'=>$request->region,
            'city_id'=>$request->id,
        ]);
        return redirect()->back()->with('success','Successfully Added Region');
    }
    public function delete($id){
        $region=Region::findOrFail($id);
        $region->delete();
        return redirect()->back()->with('success','Successfully Deleted Region');
    }
    public function update(Request $request){
        $request->validate([
            'name'=>'required|unique:regions,name,'.$request->id,
        ]);
        $region=Region::findOrFail($request->id);
        $region->update([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Successfully Update Region');

    }
}
