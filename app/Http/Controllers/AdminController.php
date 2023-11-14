<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function index(){
        $admins=Admin::paginate(10);
        $roles = Role::pluck('name','name')->all();
        return view('admin.show_admin',compact('admins','roles'));
    }
    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('admin.add_admin',compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'password' => 'required|min:6',
            'email' => ['required', 'unique:admins,email'],
            'photo'=> 'image|mimes:jpeg,png,jpg,gif',
            'roles'=>'required',
        ]);
        if ($request->hasFile('photo')) {
            $img = $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('profile', $img, 'admin');
        } else {
            $img = 'profile.jpg';
        }
        $admin=Admin::create([
            'name' => $request->firstName.' '.$request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $img,
        ]);
        $admin->assignRole($request->input('roles'));
        return redirect()->back()->with('success', 'Successfully Added Admin');
    }

    public  function editProfile($id){
        $admin=Admin::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        return view('admin.profile',compact('admin','roles'));
    }
    public function update(Request $request){
        $id=$request->id;
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:admins,email,'.$id],
            'photo'=> 'image|mimes:jpeg,png,jpg,gif',
            'roles'=>'required',
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        $admin=Admin::findOrFail($id);
        $oldImg = $admin->photo;
        if ($request->hasFile('photo')) {
            $newImg = $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('profile/', $newImg, 'admin');
            if ($oldImg !== 'profile.jpg')
                Storage::disk('admin')->delete('profile/' . $oldImg);
        } else {
            $newImg=$oldImg;
        }
        $input['photo']=$newImg;
        $admin->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $admin->assignRole($request->input('roles'));
        return redirect()->back()->with('success-update-admin','Successfully Update Profile');
    }
    public function  profile(){
        $admin=Auth::user();
        $roles = Role::pluck('name','name')->all();
        return view('admin.profile',compact('admin','roles'));
    }

    public function delete($id){
        $admin=Admin::findOrFail($id);
        if($admin->photo !='profile.jpg'){
            Storage::disk('admin')->delete('admin_image/profile/' . $admin->photo);
        }
        $admin->delete();
        return redirect()->back()
            ->with('success','Successfully Deleted Admin');
    }

    public function status(Request $request){
        $admin=Admin::findOrFail($request->id);
        if($admin->status=='active'){
            $admin->update(['status'=>'suspended']);
        }else{
            $admin->update(['status'=>'active']);
        }

        return redirect()->back()->with('success', 'Successfully Changed Status');
    }

}
