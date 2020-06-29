<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $guarded = [];

    public function foodRequest()
    {
        return  $this->hasMany(food_request::class);
    }
}
