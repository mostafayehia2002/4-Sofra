<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'client_id', 'rate', 'comment');

    public function client(){

        return $this->belongsTo(Client::class);
    }
}
