<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\OrderResource;
use App\Models\Order;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use GeneralResponse;

public function getPendingOrder(Request $request){
    $restaurant=$request->user('restaurant_api')->id;
    $order=Order::with('products')
        ->where('restaurant_id',$restaurant)
        ->where('status','pending')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
if(count($order)>0) {
    return $this->returnData(200, 'orders', OrderResource::collection($order));
}
    return $this->returnError('Not Found Pending Orders',401);
}

    public function getAcceptedOrder(Request $request){
        $restaurant=$request->user('restaurant_api')->id;
        $order=Order::with('products')
            ->where('restaurant_id',$restaurant)
            ->where('status','accepted')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        if(count($order)>0) {
            return $this->returnData(200, 'orders', OrderResource::collection($order));
        }
        return $this->returnError('Not Found Accepted Orders',401);
    }

    public function getDeliveredOrder(Request $request){
        $restaurant=$request->user('restaurant_api')->id;
        $order=Order::with('products')
            ->where('restaurant_id',$restaurant)
            ->where('status','delivered')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        if(count($order)>0) {
            return $this->returnData(200, 'orders', OrderResource::collection($order));
        }
        return $this->returnError('Not Found Accepted Orders',401);
    }
    public function acceptOrder(Request $request,$id){
        $restaurant=$request->user('restaurant_api')->id;
          $order=Order::where('restaurant_id',$restaurant)->where('id',$id)->first();
        if($order){
          $order->update([
              'status'=>'accepted',
          ]);
         return $this->returnSuccessMessage(200,'Successfully Accept Order');
        }
      return $this->returnError('Order Not Found',404);

}

    public  function rejectOrder( Request $request,$id){
        $restaurant=$request->user('restaurant_api')->id;
        $order=Order::where('restaurant_id',$restaurant)->where('id',$id)->first();
        if($order){
            $order->update([
                'status'=>'rejected',
            ]);
            return $this->returnSuccessMessage(200,'Successfully Rejected Order');
        }
        return $this->returnError('Order Not Found',404);
    }

    public function deliveredOrder(Request $request,$id){
        $restaurant=$request->user('restaurant_api')->id;
        $order=Order::where('restaurant_id',$restaurant)->where('id',$id)->first();
        if($order){
            $order->update([
                'status'=>'delivered',
            ]);
            return $this->returnSuccessMessage(200,'Successfully Delivered Order');
        }
        return $this->returnError('Order Not Found',404);

    }
}
