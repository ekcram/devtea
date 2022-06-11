<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // onDelete('cascade') -> cuando eliminemos un usuario, también se eliminará su profile
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->string('username');
            $table->date('date_of_birth')->nullable();
            $table->string('country')->nullable();
            $table->text('bio')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender');
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
        Schema::dropIfExists('profiles');
    }
}
