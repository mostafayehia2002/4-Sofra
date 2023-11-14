<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\OrderResource;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function Laravel\Prompts\text;

class ClientMainController extends Controller
{
    //
    use GeneralResponse;
    public function getRestaurants(Request $request)
    {
        $restaurants = Restaurant::where(function($query)use($request){
            if($request->has('city_id')){
                $regions_id=City::find($request->city_id);
                if($regions_id){
                   $regions_id=$regions_id->regoins->pluck('id')->toArray();
                    $query->whereIn('region_id',$regions_id);
                }
            }
        })->orWhere(function($query)use ($request){
            if($request->has('restaurant_name')){
                $query->where('name','like',"%".$request->restaurant_name."%");
            }

        })->paginate(10);

        if(count($restaurants)>0) {
            return $this->returnData(200, 'restaurants', $restaurants);
        }
        return $this->returnError(' Not found Restaurants', 404);
    }

    public function getRestaurantDetails($id)
    {
        $restaurants = Restaurant::with(['products', 'region','reviews'])->where('id', $id)->first();
        if ($restaurants) {
            return $this->returnData(200, 'restaurants', $restaurants);
        }
        return $this->returnError(' Not found Restaurants', 404);
    }

    public function addReview(Request $request){
         $client=$request->user('client_api');
         $restaurant=Restaurant::find($request->restaurant_id);
        $validate = Validator::make($request->all(),[
            'rate'=>'required|integer|between:1,5',
        ]);
        if( $validate->fails()) {
            return $this->returnError($validate->errors(), 401);
        }
        if($validate->validated()){
            if(empty($restaurant)){
                return $this->returnError('Restaurant Not Found',404);
            }
            $restaurant->reviews()->attach($client->id, ['rate' => $request->rate,'comment' => $request->comment]);
            return $this->returnSuccessMessage(200, 'Successfully Add Rate');
        }
        return $this->returnError('Failed To Send Review',401);

    }


}
