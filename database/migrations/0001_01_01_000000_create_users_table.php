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
            $table->string('fullname', 100);
            $table->string('email', 255)->unique();
            $table->string('phone', 20);
            $table->string('password', 100);
            $table->string('image')->nullable();
            $table->string('forgot_token')->nullable();
            $table->string('active_token')->nullable();
            $table->string('upgrade_token')->nullable();
            $table->string('remember_token')->nullable();
            $table->integer('status_disable');
            $table->integer('status_role');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
