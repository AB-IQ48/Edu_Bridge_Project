<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visa_scores', function (Blueprint $table) {
            $table->unsignedTinyInteger('language_score')->default(0)->after('documentation_score');
            $table->unsignedTinyInteger('interview_score')->default(0)->after('language_score');
        });
    }

    public function down(): void
    {
        Schema::table('visa_scores', function (Blueprint $table) {
            $table->dropColumn(['language_score', 'interview_score']);
        });
    }
};
