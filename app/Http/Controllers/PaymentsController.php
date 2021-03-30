<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Order;
use App\Dish;

class PaymentsController extends Controller
{
    // public function pay() {
    //     return view('payment');
    // }

    public function prova(Request $request) {
        $data = $request->all();

        $request->validate([
            'client_name'=> 'required|max:100',
            'client_surname'=> 'required|max:100',
            'client_address'=> 'required|max:100',
            'client_mail'=> 'required|max:100|email:rfc,dns',
            'order_date'=> 'required'
        ]);

        $order = new Order();
        $order->fill($data);
        $order->status="accepted";
        $order_result = $order->save();


        foreach($data['dish_name'] as $key => $slug) {
            $slug = Str::slug($slug, '-');
            $dishes[$key] = Dish::where('slug', $slug)->first();
            if($order_result) {
                if(!empty($dishes[$key])) {
                    $dishes[$key]->orders()->attach($order->id);
                }
            }
        }
        
        return view('guest.prova' , compact('data'));
    }
}
