<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('observations', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->unsignedBigInteger('course_id');

            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('observations');
    }
};
