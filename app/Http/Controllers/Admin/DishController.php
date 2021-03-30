<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class DishController extends Controller
{
    private $validation = [
        'name'=> 'required|max:100',
        'img'=> 'required|mimes:jpeg,jpg,bmp,png,webp',
        'ingredients'=> 'required|max:1000',
        'courses'=> 'required',
        'description'=> 'required|max:1500',
        'price'=> 'required|numeric|max:9999',
        'visibility'=> 'required'
    ];

    public $courses = [
        "Antipasti",
        "Primi",
        "Secondi",
        "Dessert",
        "Bevande",
        "Piatto completo",
        "Contorni"
    ]; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {   
        $restaurant = Restaurant::where('slug', $slug)->first();
        $restaurants = Restaurant::where('user_id', Auth::id())->get();
        // $dishes = Dish::where('restaurant_id', $restaurant->id)->orderBy('name')->get();
        return view('admin.dishes.index', compact('restaurant', 'restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {   
        $restaurant = Restaurant::where('slug', $slug)->first();
        $restaurants = Restaurant::where('user_id', Auth::id())->get();
        $courses = $this->courses;

        return view ('admin.dishes.create', compact('restaurant', 'courses', 'restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        
        $data = $request->all();
        // dd($data);
        $request->validate($this->validation);
        
        $dish = new Dish();
        $dish->fill($data);
        $dish->slug = Str::slug($dish->name, '-');
        $restaurant = Restaurant::where('slug', $slug)->first();
        // dd($restaurant->id);
        $dish->restaurant_id = $restaurant->id;

        if(!empty($data["img"])) {
            $dish['img'] = Storage::disk('public')->put('immages', $dish['img']);
        }

        $dish_result = $dish->save();

        return redirect()
            ->route('admin.restaurants.dishes.index', $restaurant->slug)
            ->with('message', "Il piatto " . $dish->name . " è stato aggiunto correttamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $dish_slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        $restaurants = Restaurant::where('user_id', Auth::id())->get();
        $dish = Dish::where('slug', $dish_slug)->first();
        return view('admin.dishes.show', compact('dish', 'restaurant', 'restaurants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $dish_slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        $restaurants = Restaurant::where('user_id', Auth::id())->get();
        $dish = Dish::where('slug', $dish_slug)->get()->first();
        $courses = $this->courses;
        if(empty($dish)){
            return view('404.error');
        } else return view('admin.dishes.edit', compact('dish', 'restaurant', 'restaurants', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, $dish_slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        $dish = Dish::where('slug', $dish_slug)->first();
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'], '-');

        $request->validate($this->validation);

        if(!empty($data["img"])) {
            // verifico se è presente un'immagine precedente, se si devo cancellarla
            if(!empty($dish->img)) {
                Storage::disk('public')->delete($dish->img);
            }

            $data["img"] = Storage::disk('public')->put('immages', $data["img"]);
        }

        $dish->update($data);

        return redirect()
            ->route('admin.restaurants.dishes.index', $restaurant->slug)
            ->with('message', "Il piatto " . $dish->name . " è stato modificato correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $dish_slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        $dish = Dish::where('slug', $dish_slug)->first();
        $dish->delete();

        return redirect()
            ->route('admin.restaurants.dishes.index', $restaurant->slug)
            ->with('message', "Il piatto " . $dish->name . " è stato eliminato correttamente");
    }
}
