<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('client_id', 'cost', 'delivary_cost', 'total_cost', 'payment_type_id', 'status', 'address', 'restaurant_id', 'commission','confirm');


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price','quantity','notes');
    }
    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }



    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }


}
