<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('card_number');
            $table->string('card_name');
            $table->string('card_expiry');
            $table->integer('card_cvc');
            $table->string('cus_country');
            $table->string('cus_email');
            $table->integer('cus_phone');
            $table->integer('cus_zipcode');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('price');
            $table->string('payment_type');
            $table->timestamps();
        });

        return back();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
