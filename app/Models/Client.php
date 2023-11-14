<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'region_id', 'image', 'remember_me', 'api_token', 'code');
    protected $hidden = array('password', 'remember_me', 'api_token', 'code');

    public function regoin()
    {
        return $this->belongsTo(Regoin::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function token()
    {
        return $this->morphOne('App\Models\Token', 'tokenable');
    }

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class)->withPivot('rate','comment');
    }

}
