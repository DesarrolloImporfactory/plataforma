<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('abonos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('archivo')->nullable();
            $table->float('valor');
            $table->bigInteger('forma_id')->unsigned()->nullable();
            $table->foreign('forma_id')->references('id')->on('formas')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('cartera_id')->unsigned()->nullable();
            $table->foreign('cartera_id')->references('id')->on('carteras')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('abonos');
    }
};
