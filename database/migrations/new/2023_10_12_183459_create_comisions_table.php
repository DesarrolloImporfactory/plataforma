<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('comisions', function (Blueprint $table) {
            $table->id();

            $table->float('valor',8,2)->nullable();
            $table->bigInteger('cartera_id')->unsigned()->nullable();
            $table->foreign('cartera_id')->references('id')->on('carteras')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('vendedor_id')->unsigned()->nullable();
            $table->foreign('vendedor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('tipo_id')->unsigned()->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipo_comisions')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comisions');
    }
};
