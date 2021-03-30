<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class PublicController extends Controller
{
    public function home() {
        $restaurants = Restaurant::all();
        return view('guest.homepage', compact('restaurants'));
    }

    public function show($slug) {
        $restaurant = Restaurant::where('slug', $slug)->first();
        return view('guest.details', compact('restaurant'));
    }
}
