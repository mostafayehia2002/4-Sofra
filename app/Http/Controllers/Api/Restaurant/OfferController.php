<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    use GeneralResponse;
    public function addOffer(Request $request){
        $restaurant=$request->user();
        $validate = validator::make($request->all(),[
            'name'=>'required|unique:offers',
            'description'=>'required',
            'start_time'=>'required|date',
            'end_time'=>'required|date|after:start_date',
            'image'=>'required|image|mimes:jpg,png,jpeg',
        ]);
        if($validate->fails()) {
            return $this->returnError($validate->errors(), 401);
        }
        if($validate->validated()) {
            $data=$request->all();
            if($request->hasFile('image')){
                $image_name=time().$request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('/offers',$image_name,'restaurant');
                $data['image'] =$image_name;
                $data['restaurant_id']=$restaurant->id;
                $offer=Offer::create($data);
                if($offer)
                    return $this->returnData(200,'offers',$offer,'Successfully Added Offer');
            }
        }

        return $this->returnError('Bad Request',401);


    }

    public  function  updateOffer(Request $request,$id){
        $restaurant = $request->user();
        $offer=$restaurant->offers()->where('id',$id)->first();
        if(empty($offer)) {
            return $this->returnError('Offer Not Found',404);
        }
        $validate = validator::make($request->all(), [
            'name' => 'required|unique:offers,name,'.$offer->id,
            'description'=>'required',
            'start_time'=>'required|date',
            'end_time'=>'required|date|after:start_date',
            'image'=>'image|mimes:jpg,png,jpeg',
        ]);
        if ($validate->fails()) {
            return $this->returnError($validate->errors(), 401);
        }
        if ($validate->validated()) {
            $data = $request->all();
            if($request->hasFile('image')) {
                $image_name = time() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('/offers', $image_name, 'restaurant');
                Storage::disk('restaurant')->delete('offers/' . $offer->image);
                $data['image']=$image_name;
            }else{
                $data['image'] = $offer->image;
            }

            $data['restaurant_id'] = $restaurant->id;
            $update= $offer->update($data);
            if($update){
                return $this->returnData(200, 'offer', $offer, 'Successfully Updated Offer');
                   }
                return $this->returnError('Bad Request',401);
         }
    }
    public function editOffer(Request $request,$id){

        $restaurant = $request->user();
        $offer =$restaurant->offers()->where('id',$id)->first();
        if ($offer) {
            return $this->returnData(200, 'products', $offer, 'Successfully retrieved data');
        }
        return  $this->returnError('Offer not found',404);
    }

    public  function  deleteOffer(Request $request,$id){
        $restaurant = $request->user();
        $offer = $restaurant->offers()->where('id',$id)->first();
        if($offer) {
            Storage::disk('restaurant')->delete('offers/'.$offer->image);
            $offer->delete();
            return $this->returnSuccessMessage(200,'Successfully Deleted Offer');
        }
        return  $this->returnError('Offer not found',404);
    }
    public function getOffers(Request $request)
    {
        $restaurant = $request->user();
        $offers =$restaurant->offers()->paginate(10);
        if(count($offers)>0) {
            return $this->returnData(200, 'offer', $offers, 'Successfully retrieved data');
        }
        return  $this->returnError(' Not found Offers',404);

    }


}
