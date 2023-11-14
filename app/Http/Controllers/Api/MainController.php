<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\PaymentType;
use App\Models\Review;
use App\Models\Setting;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{

    use GeneralResponse;
    //
    public function getCategories(){
            $categories= Category::get(['id','name']);
            if(count($categories)>0) {
                return $this->returnData(200, 'categories', $categories, 'successfully get data');
            }
            return  $this->returnError('No Category Found',404);

    }

    public function getCites(){

            $cities= City::with('regions')->get(['id','name']);
            if(count($cities)>0) {
                return $this->returnData(200, 'cities', $cities);
            }
            return  $this->returnError('No Cites Found',404);

    }

    public function getPayments(){
        $payments= PaymentType::all();
        if(count($payments)>0){
            return  $this->returnData(200,'payments',$payments);
        }
        return $this->returnError('No Found Payments',404);
    }

    public function contactUs(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => ['required', 'numeric', 'digits:11'],
            'message' => 'required',
            'issue_type' => 'in:complaint,suggestion,query',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors(), 401);
        }
        $contact = Contact::create($request->all());
        if ($contact) {
            return $this->returnSuccessMessage(200, 'Your Message Has Been Successfully Registered');
        }
        return $this->returnError(401, 'Failed to Send Message');
    }

    public function aboutApp(){
        $about=Setting::get('about_app')->first();
        if($about){
            return $this->returnData(200,'about',$about);
        }
        return  $this->returnError('Not Found Data',404);
    }
    public function getReviews(Request $request){
        $restaurant_id=$request->user('restaurant_api')->id;
       $reviews=Review::with('client')->where('restaurant_id',$restaurant_id)->paginate(10);
       if(count($reviews)>0){
           return $this->returnData(200,'reviews',$reviews);
       }
       return  $this->returnError('Not Found Reviews',404);
    }
}
