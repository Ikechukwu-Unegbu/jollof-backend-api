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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('slug');
            $table->string('description')->nullable();
            $table->string('email');
            $table->string('address')->nullable();
            $table->integer('business_type_id')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('lower_delivery')->nullable();
            $table->string('upper_delivery')->nullable();
            $table->string('cac_document')->nullable();
            $table->string('tin_document')->nullable();
            $table->string('personal_id_card')->nullable();
            $table->integer('coupon_running')->default(0)->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
