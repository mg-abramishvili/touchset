<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function addons()
    {
        return $this->belongsToMany('App\Models\Addon')->withPivot(['price']);
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }
}
