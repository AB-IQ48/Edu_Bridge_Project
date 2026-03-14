<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_type', 20)->default('student')->after('password');

            // Company registration fields (nullable for students)
            $table->string('company_name')->nullable()->after('user_type');
            $table->string('company_email')->nullable()->after('company_name');
            $table->string('company_phone')->nullable()->after('company_email');
            $table->string('company_website')->nullable()->after('company_phone');
            $table->string('company_address')->nullable()->after('company_website');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'user_type',
                'company_name',
                'company_email',
                'company_phone',
                'company_website',
                'company_address',
            ]);
        });
    }
};

