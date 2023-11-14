<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use App\Traits\GeneralResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use GeneralResponse;
    public function addProduct(Request $request){
        $restaurant=$request->user();
        $validate = validator::make($request->all(),[
            'name'=>'required|unique:products',
            'description'=>'required',
            'price'=>'required',
            'price_offer'=>'required',
            'processing_time'=>'required',
            'image'=>'required|image|mimes:jpg,png,jpeg',
        ]);
        if($validate->fails()) {
            return $this->returnError($validate->errors(), 401);
        }
        if($validate->validated()) {
             $data=$request->all();
             $data['restaurant_id']=$restaurant->id;
            if($request->hasFile('image')) {
                $image_name = time().$request->file('image')->getClientOriginalName();
                $data['image'] = $image_name;
                $request->file('image')->storeAs('/products', $image_name, 'restaurant');
            }
              $product=Product::create($data);
                if($product) {
                    return $this->returnData(200, 'product', $product, 'Successfully Added Product');
                }

                  return $this->returnError('Bad Request',401);
        }

    }
    public  function  updateProduct(Request $request,$id){
        $restaurant = $request->user();
       $product=$restaurant->products()->where('id',$id)->first();
        if(empty($product)) {
            return $this->returnError('Product Not Found',404);
        }
        $validate = validator::make($request->all(), [
            'name' => 'required|unique:products,name,'.$product->id,
            'description' => 'required',
            'price' =>'required',
            'price_offer' =>'required',
            'processing_time' =>'required',
            'image'=>'image|mimes:jpg,png,jpeg',
        ]);
        if ($validate->fails()) {
            return $this->returnError($validate->errors(), 401);
        }
           if ($validate->validated()) {
                 $data = $request->all();
               if($request->hasFile('image')) {
                   $image_name = time() . $request->file('image')->getClientOriginalName();
                   $request->file('image')->storeAs('/products', $image_name, 'restaurant');
                   Storage::disk('restaurant')->delete('products/' . $product->image);
                   $data['image']=$image_name;
               }else{
                   $data['image'] = $product->image;
               }

                $data['restaurant_id'] = $restaurant->id;
                $update= $product->update($data);
               if($update)
               return $this->returnData(200, 'product', $product);
            }
           return $this->returnError('Bad Request',401);

        }
    public function editProduct(Request $request,$id){

            $restaurant = $request->user();
            $product =$restaurant->products()->where('id',$id)->first();
            if ($product) {
                return $this->returnData(200, 'products', $product);
            }
            return  $this->returnError('Product not found',404);
    }
    public  function  deleteProduct(Request $request,$id){
        $restaurant = $request->user();

        $product = $restaurant->products()->where('id',$id)->first();
        if($product) {
            Storage::disk('restaurant')->delete('products/'.$product->image);
            $product->delete();
            return $this->returnSuccessMessage(200,'Successfully Deleted Product');
        }
        return  $this->returnError('Product not found',404);
    }
    public function getProducts(Request $request)
    {
        $restaurant = $request->user();
        $products =$restaurant->products()->paginate(10);
        if (count($products)>0) {
            return $this->returnData(200, 'products', $products);
        }
            return  $this->returnError(' Not found Products',404);

    }



}

