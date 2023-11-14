<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model 
{

    protected $table = 'payment_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}