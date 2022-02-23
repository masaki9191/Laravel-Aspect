<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('builds', function (Blueprint $table) {
            $table->id();
            $table->integer('state')->default(0);
            $table->string('name');
            $table->string('address');
            $table->string('scale');
            $table->string('construction');
            $table->integer('room');
            $table->float('total_area');
            $table->float('rent_area_from');
            $table->float('rent_area_to');
            $table->date('completion');
            $table->text('point');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('builds');
    }
}
