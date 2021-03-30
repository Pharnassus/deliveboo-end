<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'img',
    'p_iva',
    'address'
  ];

  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }

  public function dishes()
  {
    return $this->hasMany('App\Dish');
  }


}
