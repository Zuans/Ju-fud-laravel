<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class food_request extends Model
{
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(transaction::class);
    }
}
