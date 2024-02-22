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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('cover')->nullable();
            $table->boolean('show_username')->nullable()->default(0);
            $table->boolean('show_email')->nullable()->default(0);
            $table->string('optional_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('cover');
            $table->dropColumn('show_username');
            $table->dropColumn('show_email');
            $table->dropColumn('optional_email');
        });
    }
};
