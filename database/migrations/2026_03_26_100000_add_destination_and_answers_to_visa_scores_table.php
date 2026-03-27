<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visa_scores', function (Blueprint $table) {
            $table->string('destination_country', 64)->nullable()->after('student_id');
            $table->json('questionnaire_json')->nullable()->after('total_score');
        });
    }

    public function down(): void
    {
        Schema::table('visa_scores', function (Blueprint $table) {
            $table->dropColumn(['destination_country', 'questionnaire_json']);
        });
    }
};
