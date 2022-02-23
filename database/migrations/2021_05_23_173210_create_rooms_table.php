<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();   
            $table->integer('no');
            $table->float('price');
            $table->string('rent_size');
            $table->float('area');   
            $table->string('facility');
            $table->string('point');
            $table->timestamps();
                
            $table->foreign('build_id')->references('id')->on('builds');
            $table->foreignId('build_id')
              ->constrained()
              ->onUpdate('cascade')
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
        Schema::dropIfExists('rooms');
    }
}
