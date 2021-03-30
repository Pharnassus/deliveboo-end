<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_id');
          $table->string('name', 100);
          $table->string('slug', 100);
          $table->string('img')->nullable();
          $table->char('p_iva', 11)->unique();
          $table->string('address', 100);
          $table->timestamps();

          //relation
          $table->foreign('user_id')
            ->references('id')
            ->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
