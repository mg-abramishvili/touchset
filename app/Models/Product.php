<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'gallery',
        'price',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'is_new',
        'is_popular',
        'is_onsale',
    ];

    protected $casts=['gallery'=>'json'];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute')->withPivot(['value']);
    }

    public function addons()
    {
        return $this->belongsToMany('App\Models\Addon')->withPivot(['price']);
    }
}
