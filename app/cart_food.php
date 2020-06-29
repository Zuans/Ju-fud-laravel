<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart_food extends Model
{
    protected $table = 'cart_foods';

    protected $guarded = [];

    protected $fillable = ['title', 'price', 'jumlah', 'total', 'category', 'image_src', 'food_id', 'description', 'user_id'];

    public function food()
    {
        return $this->hasMany(food::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
