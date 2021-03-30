<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'img',
    'ingredients',
    'courses',
    'description',
    'price',
    'visibility',
  ];

  public function restaurant()
  {
    return $this->belongsTo('App\Restaurant');
  }

  public function orders()
  {
    return $this->belongsToMany('App\Order');
  }
}
