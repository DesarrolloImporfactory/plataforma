<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('carteras', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->date('fecha');
            $table->float('saldo');
            $table->bigInteger('alumno_id')->unsigned()->nullable();
            $table->foreign('alumno_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

          

            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('carteras');
    }
};
