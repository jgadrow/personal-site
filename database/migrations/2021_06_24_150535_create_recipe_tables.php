<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
          $table->uuid('id');
          $table->string('name');
          $table->primary('id');
        });

        Schema::create('recipe_ingredients', function (Blueprint $table) {
          $table->uuid('id');
          $table->string('amount');
          $table->string('name');
          $table->string('note');
          $table->string('uom');
          $table->uuid('recipe_id');
          $table->primary('id');
        });

        Schema::create('recipe_steps', function (Blueprint $table) {
          $table->uuid('id');
          $table->integer('position');
          $table->string('text');
          $table->uuid('recipe_id');
          $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
        Schema::dropIfExists('recipe_ingredients');
        Schema::dropIfExists('recipe_steps');
    }
}
