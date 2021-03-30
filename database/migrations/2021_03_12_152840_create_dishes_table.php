<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('restaurant_id');
          $table->string('name', 100);
          $table->string('slug', 100);
          $table->string('img');
          $table->text('ingredients');
          $table->string('courses');
          $table->text('description', 1500);
          $table->float('price', 6, 2);
          $table->boolean('visibility');
          $table->timestamps();


          //relation
          $table->foreign('restaurant_id')
            ->references('id')
            ->on('restaurants')
            ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
