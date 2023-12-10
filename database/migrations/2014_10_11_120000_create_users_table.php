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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('phone_verify_code')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->integer('phone_attempts_left')->default(0);
            $table->integer('otp_requests_left')->default(0);
            $table->timestamp('phone_last_attempt_date')->nullable();
            $table->timestamp('phone_verify_code_sent_at')->nullable();
            $table->timestamp('phone_last_update_date')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
