<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'phone', 'region_id', 'minimum_order', 'delivery_cost', 'whatsapp', 'image', 'status', 'remember_me', 'api_token', 'code');
    protected $hidden = array('password', 'remember_me', 'api_token', 'code');

    //done✅
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //done✅
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }


    //done✅
    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_restaurant','restaurant_id','category_id');
    }

  //done✅
    public function region()
    {
        return $this->belongsTo(Region::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function notifications()
    {
        return $this->morphMany('App\Models\Offer', 'notificationable');
    }
    public function token()
    {
        return $this->morphOne('App\Models\Token', 'tokenable');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }



    //client with review
    //done✅
    public function reviews()
    {
        return $this->belongsToMany(Client::class,'reviews','restaurant_id','client_id')->withPivot('rate','comment');
    }

}
