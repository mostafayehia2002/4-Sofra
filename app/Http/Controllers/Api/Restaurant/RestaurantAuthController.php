<?php

namespace App\Http\Controllers\Api\Restaurant;
use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\RestaurantResource;
use App\Mail\ResetPassword;
use App\Models\Restaurant;
use App\Traits\component;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RestaurantAuthController extends Controller
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
        $restaurant = Restaurant::where('email', $request->email)->first();
        if ($restaurant){
            if (Hash::check($request->password,$restaurant->password)) {
                return $this->returnData(200, 'restaurant',new RestaurantResource($restaurant));
            }

        }
        return $this->returnError('Incorrect Data',401);
    }


    public function register(Request $request){
        $validate = validator::make($request->all(),[
            'name' => 'required|string|between:2,100|unique:restaurants',
            'email' => 'required|string|email|max:100|unique:restaurants',
            'region_id'=>'required',
            'password' => 'required|string|same:confirm_password|min:8',
            'confirm_password'=>'required|min:8',
            'minimum_charger'=>'required',
            'delivery_cost'=>'required',
            'phone'=>'required|unique:restaurants',
            'whatsapp'=>'required|unique:restaurants',
            'image'=>'required|image|mimes:jpg,png,jpeg',
            'category_id'=>'required'
        ]);
        if($validate->fails())
           return $this->returnError($validate->errors(),401);

            $data = $request->all();
           $categories =$request->category_id;
            //
            $data['password'] = bcrypt($request->password);
            //save image in disk
            $image_name=time().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('/profile',$image_name,'restaurant');
            $data['image'] =$image_name;
            //create api token
            $data['api_token']=$this->createToken();
            //insert data into database
            $restaurant = Restaurant::create($data);
            $restaurant->categories()->attach($categories);
            if($restaurant)
                return $this->returnData(200, 'restaurant',new RestaurantResource($restaurant));

            return $this->returnError('bad request',401);
    }

    public function resetPassword(Request $request){
        $validate = validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
        ]);
        if($validate->fails()){
            return $this->returnError($validate->errors(),401);
        }
        $restaurant=Restaurant::where('email',$request->email)->first();
        if($restaurant){
            $code=$this->createResetCode();
            $restaurant->update(['code'=>$code]);
            Mail::to($restaurant)->send(new ResetPassword($code));
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
        $restaurant = Restaurant::where('code', $request->code)->first();
        if ($restaurant) {
            $newPassword = bcrypt($request->new_password);
            $restaurant->update(['password' => $newPassword,'api_token'=>$this->createToken(),'code'=>$this->createResetCode()]);
            return $this->returnSuccessMessage(200, 'Password Changed Successfully');
        } else {
            return $this->returnError('Invalid Code', 401);
        }
    }
    public function profile(Request $request){
        try {
            $data = $request->user();
            return $this->returnData(200, 'restaurant', new RestaurantResource($data));
        }catch (\Exception $ex){
            return $this->returnError($ex->getMessage(),401);
        }
    }

    public function updateProfile(Request $request){
        $restaurant = $request->user();
        $validate = validator::make($request->all(),[
            'name' => 'required|string|between:2,100|unique:restaurants,name,'.$restaurant->id,
            'email' => 'required|string|email|max:100|unique:restaurants,email,'.$restaurant->id,
            'region_id'=>'required',
            'minimum_order'=>'required',
            'delivery_cost'=>'required',
            'phone'=>'required|unique:restaurants,phone,'.$restaurant->id,
            'whatsapp'=>'required|unique:restaurants,whatsapp,'.$restaurant->id,
            'image'=>'image|mimes:jpg,png,jpeg'

        ]);
        if($validate->fails()){
            return $this->returnError($validate->errors(),401);
        }
            $data = $request->all();
            //save image in disk
            if($request->hasFile('image')){
                $image_name=time().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('/profile',$image_name,'restaurant');
                $data['image'] =$image_name;
                Storage::disk('restaurant')->delete( 'profile/'.$restaurant->image);
            }else{
                $data['image']=$restaurant->image;
            }

            //update data into database
            $restaurant->update($data);
            if($restaurant) {
                return $this->returnData(200, 'restaurant', new RestaurantResource($restaurant));
            }

            return $this->returnError('bad request',401);

    }

    public  function logout(Request $request){
        try {
            $restaurant= $request->user();
            $restaurant->update(['api_token' => $this->createToken()]);
            return $this->returnSuccessMessage(200, 'Successfully Logout');
        }catch (\Exception $ex){

            return $this->returnError($ex->getMessage(),401);
        }

    }







}
