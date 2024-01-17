<?php

use App\Models\Raction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::connection('cursos')->create('ractions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('value',[Raction::LIKE,Raction::DISLIKE]);
            //espesificamos que es una tabla polimorfica con el termino able y el tipo de dato
            $table->unsignedBigInteger('ractionable_id');
            $table->string('ractionable_type');
            $table->timestamps();
        });
    }

   
    
    public function down()
    {
        Schema::connection('cursos')->dropIfExists('ractions');
    }
};
