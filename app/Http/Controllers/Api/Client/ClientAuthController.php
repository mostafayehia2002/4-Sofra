<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Restaurant\RestaurantResource;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Restaurant;
use App\Traits\component;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ClientAuthController extends Controller
{
    //
    use GeneralResponse;
    use component;

    public  function login(Request $request)
    {
        //validation
        $validate = validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:8',
        ]);
        //check errors
        if ($validate->fails()) {
            return $this->returnError($validate->errors(),401);
        }
        //get data
        $client = Client::where('email', $request->email)->first();
        if($client){
            if (Hash::check($request->password,$client->password)) {
                return $this->returnData(200, 'client',new ClientResource($client), 'Successfully Logged In');
            }
        }

        return $this->returnError('Incorrect Data',401);
    }

    public function register(Request $request){
        $validate = validator::make($request->all(),[
            'name' => 'required|string|between:2,100|unique:clients',
            'email' => 'required|string|email|max:100|unique:clients',
            'phone'=>'required|unique:clients',
            'password' => 'required|string|same:confirm_password|min:8',
            'confirm_password'=>'required|min:8',
            'region_id'=>'required',
            'image'=>'required|image|mimes:jpg,png,jpeg'
        ]);
        if($validate->fails())
            return $this->returnError($validate->errors(),401);

        $data = $request->all();
        //
        $data['password'] = bcrypt($request->password);
        //save image in disk
        $image_name=time().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('/profile',$image_name,'client');
        $data['image'] =$image_name;
        //create api token
        $data['api_token'] = $this->createToken();
        //insert data into database
        $client = Client::create($data);
        if($client)
            return $this->returnData(200, 'client',new ClientResource($client), 'Successfully Registered In');

        return $this->returnError('bad request',401);
    }


    public function resetPassword(Request $request){

        $validate = validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
        ]);
        if($validate->fails()){
            return $this->returnError($validate->errors(),401);
        }

        $client=Client::where('email',$request->email)->first();
        if($client){
            $code=$this->createResetCode();
            $client->update(['code'=>$code]);
            Mail::to($client)->send(new ResetPassword($code));
            return $this->returnSuccessMessage(200,'Success Send Message To Email');
        }
        return  $this->returnError('Incorrect Data',401);
    }

    public function changePassword(Request $request){
        $validate = validator::make($request->all(), [
            'code'=>'required|min:6|max:6',
            'new_password' => 'required|string|same:confirm_password|min:8',
            'confirm_password'=>'required|min:8',
        ]);
        //check errors
        if ($validate->fails()) {
            return $this->returnError($validate->errors(),401);
        }
        $client = Client::where('code', $request->code)->first();
        if ($client) {
            $newPassword = bcrypt($request->new_password);
            $client->update(['password' => $newPassword,'api_token'=>$this->createToken(),'code'=>$this->createResetCode()]);
            return $this->returnSuccessMessage(200, 'Password Changed Successfully');
           }

            return $this->returnError('Invalid Code', 401);

    }


    public function profile(Request $request){
        try {
            $client = $request->user();

            return $this->returnData(200, 'client', new ClientResource($client), 'Successfully Retrieved Data ');

        }catch (\Exception $ex){
            return $this->returnError($ex->getMessage(),401);
        }
    }

    public function updateProfile(Request $request){
        $client = $request->user('client_api');
        $validate = validator::make($request->all(),[
            'name' => 'required|string|between:2,100|unique:clients,name,'.$client->id,
            'email' => 'required|string|email|max:100|unique:clients,email,'.$client->id,
            'region_id'=>'required',
            'phone'=>'required|unique:clients,phone,'.$client->id,
            'image'=>'image|mimes:jpg,png,jpeg'

        ]);
        if($validate->fails()){
            return $this->returnError($validate->errors(),401);
        }
        $data = $request->all();
        //save image in disk
        if($request->hasFile('image')){
            $image_name=time().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('profile/',$image_name,'client');
            $data['image'] =$image_name;
            Storage::disk('client')->delete( 'profile/'.$client->image);
        }else{
            $data['image']=$client->image;
        }

        //update data into database
        $client->update($data);
        if($client) {
            return $this->returnData(200, 'client', new ClientResource($client), 'Successfully Update Profile');
        }

        return $this->returnError('Bad Request',401);

    }

    public  function logout(Request $request){
        try {
            $client = $request->user();
            $client->update(['api_token' => $this->createToken()]);
            return $this->returnSuccessMessage(200, 'Successfully Logout');
        }catch (\Exception $ex){

            return $this->returnError($ex->getMessage(),401);
        }

    }
}
