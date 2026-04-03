<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('complaints', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'guest_name', 'guest_email']);
        });

        Schema::table('complaints', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }
};
