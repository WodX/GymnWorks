<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('serie_type_id');
            $table->string('name');
            $table->string('element1');
            $table->string('element2');
            $table->string('element3');
            $table->string('element4');
            $table->string('element5');
            $table->string('element6');
            $table->string('element7');
            $table->string('element8');
            $table->string('element9');
            $table->string('element10');
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
        Schema::dropIfExists('series');
    }
}
