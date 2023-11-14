<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait component
{

    public function createToken(){
        return  Str::random(70);
    }
    public function createResetCode(){
        return rand(111111,999999);
    }
}
