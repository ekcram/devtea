<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('like')->default(0);
            $table->unsignedBigInteger('dislike')->default(0);
            $table->unsignedBigInteger('likeable_id')->default(0); //ID del Post, Image o Project. Para la relación polimórfica.
            $table->string('likeable_type'); //Modelo del like (Post, Image, Project). Para la relación polimórfica.
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
        Schema::dropIfExists('likes');
    }
}
