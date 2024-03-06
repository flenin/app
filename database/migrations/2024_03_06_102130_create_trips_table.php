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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_location_id');
            $table->foreignId('to_location_id');
            $table->timestamp('from_date');
            $table->timestamp('to_date');
            $table->integer('adults');
            $table->integer('children');
            $table->integer('amount');
            $table->string('flight');
            $table->string('name');
            $table->string('phone');
            $table->foreignId('voucher_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
