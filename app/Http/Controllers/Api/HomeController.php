<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Category;
use App\Dish;
use App\Order;

class HomeController extends Controller
{
    public function allCategories() {
        $restaurants = Restaurant::all();
        return response()
        ->json($restaurants);
    }

    public function filter($category) {
        $categories = Category::where('name', $category)->first();
        return response()
            ->json($categories->restaurants);
    }

    public function categories() {
        $categories = Category::all();
        return response()
            ->json($categories);
    }

  //   public function details($slug) {
  //       $restaurant = Restaurant::where('slug', $slug)->first();
  //       return response()
  //           ->json($restaurant->dishes);
  //   }

  //   public function slug($slug) {
  //     $restaurant = Restaurant::where('slug', $slug)->first();
  //     return response()
  //         ->json($restaurant);
  // }

    public function charts($slug) {
      $restaurants = Restaurant::where('user_id', Auth::id())->get();
      $restaurant = Restaurant::where('slug', $slug)->first();
      $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        $months = [
            '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'
          ];

        $order_dish = [];

        foreach($dishes as $dish){
          foreach($dish->orders as $order) {
            if(!in_array($order->id, $order_dish)) {
              $order_dish[] = $order->id;
            } 
          }
        }
          foreach($months as $month) {
    
            $orders[] = Order::whereMonth('order_date', $month)->whereIn('id', $order_dish)->sum('price');
           
          }
        return response()
            ->json($orders);
    }

    public function year($slug) {

      $restaurants = Restaurant::where('user_id', Auth::id())->get();
      $restaurant = Restaurant::where('slug', $slug)->first();
      $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        $years = [
            '2020', '2021'
          ];

          $order_dish = [];

        foreach($dishes as $dish){
          foreach($dish->orders as $order) {
            if(!in_array($order->id, $order_dish)) {
              $order_dish[] = $order->id;
            } 
          }
        }
    
          foreach($years as $year) {
    
            $orders[] = Order::whereYear('order_date', $year)->whereIn('id', $order_dish)->sum('price');
           
          }
        return response()
            ->json($orders);
    }

}
