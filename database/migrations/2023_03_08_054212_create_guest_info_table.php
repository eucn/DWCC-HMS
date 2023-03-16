<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guest_information', function (Blueprint $table) {
            $table->id();
            $table ->unsignedBigInteger('guest_id');
            $table ->unsignedBigInteger('reservation_id');
            $table ->string('salutation');
            $table ->string('first_name');
            $table ->string('last_name');
            $table ->string('company_name');
            $table ->string('address');
            $table ->string('phone_number');
            $table ->integer('payment_method');
            $table ->integer('department');    
            $table->timestamps();
            // $table->foreign('guest_id')
            // ->references('id')->on('users')
            // ->onDelete('cascade');
            //  $table->foreign('reservation_id')
            // ->references('id')->on('reservations')
            // ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_info');
    }
};
