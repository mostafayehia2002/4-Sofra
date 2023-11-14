<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\OrderResource;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientOrderController extends Controller
{
    //
    public function newOrder(Request $request)
    {
        $client = $request->user();
        $validate = Validator::make($request->all(), [
            'restaurant_id' => 'required|exists:restaurants,id',
            'product.*.product_id' => 'required|exists:products,id',
            'product.*.quantity' => 'required',
            'product.*.price' => 'required',
            'address' => 'required',
            'payment_type' => 'required|exists:payment_types,id'
        ]);
        if ($validate->fails()) {
            return $this->returnError($validate->errors(), 401);
        }
        //get restaurant
        $restaurant = Restaurant::find($request->restaurant_id);
        if (!$restaurant){
            return $this->returnError('Restaurant Not Found', 404);
        }
        if($restaurant->status == 'closed') {
            return $this->returnError('Restaurant  is closed', 404);
        }
        $order = $request->user()->orders()->create([
            'restaurant_id' => $request->restaurant_id,
            'payment_type_id' => $request->payment_type,
            'address' => $request->address,
            'status' => 'pending',
            'note' => isset($request->note) ?? ''
        ]);
        //restaurant data
        $cost = 0;
        $delivary_cost = $restaurant->delivary_cost;

        $minimum_charger = $restaurant->minimum_charger;
        //app setting
        $commission_rate = Setting::find(1)->pluck('commission_rate')->first();
        //add order
        foreach ($request->product as $i) {
            $product = Product::find($i['product_id'])->first();
            if ($product) {
                $items = [$i['product_id'] => array(
                    'quantity' => $i['quantity'],
                    'price' => $product->price,
                    'notes' => $i['notes'] ?? ''
                )
                ];
                $order->products()->attach($items);
                $cost += $product->price * $i['quantity'];
            }
        }
        if ($cost >= $minimum_charger) {
            //total price and delivery cost
            $total = $cost + $delivary_cost;
            //commission rate of app from order
            $commission = $total * $commission_rate;
            $update = $order->update([
                'cost' => $cost,
                'delivery_cost' => $delivary_cost,
                'total_cost' => $total,
                'commission' => $commission,
            ]);
            if ($update) {
                $order = Order::with('products')->find($order->id);
                return $this->returnData(200, 'order', new OrderResource($order), 'The Order Has Been Ordered Successfully');
            } else {
                $order->products()->delete();
                $order->delete();
                return $this->returnError('Order Is Lass Than Minimum Charge', 401);
            }
        }
    }

    public function getAcceptedOrders(Request $request){
        $client=$request->user('client_api')->id;
        $order=Order::where('client_id',$client)->where('status','accepted')->paginate(10);
        if(count($order)>0){
            return  $this->returnData(200,'order',$order);
        }

        return $this->returnError('No Found Accepted Order',404);

    }
    public function getDeliveredOrders(Request $request){
        $client=$request->user('client_api')->id;
        $order=Order::where('client_id',$client)->where('status','delivered')->paginate(10);
        if(count($order)>0) {
            return $this->returnData(200, 'order', $order);
        }
        return $this->returnError('No Found Delivered Order',404);
    }

    public  function receiptOrder($id){
        $order=Order::where('id',$id)->first();
        if($order){
            $order->update([
                'confirm'=>1,
            ]);
            return $this->returnSuccessMessage(200,'Successfully Receipt Order');
        }
        return $this->returnError('Order Not Found',404);


    }
    public  function rejectOrder($id){
        $order=Order::where('id',$id)->first();
        if($order){
            $order->update([
                'status'=>'rejected',
            ]);
            return $this->returnSuccessMessage(200,'Successfully Rejected Order');
        }
        return $this->returnError('Order Not Found',404);
    }

    public function getOffers(){
        $offer=Offer::where('end_time','>=',now())->paginate(10);
        if(count($offer)>0){
            return $this->returnData(200, 'offers', $offer);
        }
        return $this->returnError('There Are No Offers Now',404);
    }
}
