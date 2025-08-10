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
        Schema::create('chat_supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender')->nullable(true);
            $table->unsignedBigInteger('to')->nullable(true);
            $table->foreign('sender')->references('id')->on('users');
            $table->foreign('to')->references('id')->on('users');
            $table->text('message');
            $table->timestamp('readAt')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_supports');
    }
};
