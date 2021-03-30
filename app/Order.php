<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'client_name',
    'client_surname',
    'client_address',
    'client_mail',
    'price',
    'status',
    'order_date'
  ];

  public function dishes()
  {
    return $this->belongsToMany('App\Dish');
  }
}
