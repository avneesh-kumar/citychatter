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
        Schema::create('post_message_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_message_id')->constrained('post_messages')->nullable();
            $table->foreignId('post_id')->constrained('posts')->nullable();
            $table->foreignId('from')->constrained('users')->nullable();
            $table->foreignId('to')->constrained('users')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_message_replies');
    }
};
