<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('url');

            //espesificamos que es una tabla polimorfica con el termino able y el tipo de dato
            $table->unsignedBigInteger('resourceable_id');
            $table->string('resourceable_type');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('resources');
    }
};
