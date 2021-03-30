<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = [
        [
          "name" => "italiano",
          "img" => "spaghetti.png"
        ],
        [
          "name" => "messicano",
          "img" => "nachos.png"
        ],
        [
          "name" => "cinese",
          "img" => "china.png"
        ],
        [
          "name" => "giapponese",
          "img" => "jappo.png"
        ],
        [
          "name" => "indiano",
          "img" => "indian.png"
        ],
        [
          "name" => "carne",
          "img" => "meat.png"
        ],
        [
          "name" => "pesce",
          "img" => "fish.png"
        ],
        [
          "name" => "vegetariano",
          "img" => "vegetarian.png"
        ],
        [
          "name" => "pizza",
          "img" => "pizza.svg"
        ],
        [
          "name" => "fast-food",
          "img" => "fastfood.png"
        ]

      ];
      foreach($categories as $category) {
        $newCategory = new Category();
        $newCategory->name = $category['name'];
        $newCategory->img = $category['img'];
        $newCategory->save();
      }
      
    }
}
