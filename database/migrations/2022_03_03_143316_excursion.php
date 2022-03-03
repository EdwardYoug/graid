<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Excursion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excursion',function (Blueprint $table){
           $table->id();
           $table->bigInteger('city')->index()->unsigned();
           $table->string('title')->nullable();

           $table->foreign('city')
               ->references('id')
               ->on('cities')
               ->cascadeOnUpdate()
               ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
