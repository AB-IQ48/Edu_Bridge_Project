<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('counsellor_profiles', function (Blueprint $table) {
            $table->string('city', 120)->nullable()->after('organization_name');
            $table->string('phone', 40)->nullable()->after('city');
            $table->string('website', 255)->nullable()->after('phone');
            $table->string('countries_served', 500)->nullable()->after('website');
            $table->string('languages', 255)->nullable()->after('countries_served');
            $table->text('specializations')->nullable()->after('languages');
            $table->text('bio')->nullable()->after('specializations');
        });
    }

    public function down(): void
    {
        Schema::table('counsellor_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'city',
                'phone',
                'website',
                'countries_served',
                'languages',
                'specializations',
                'bio',
            ]);
        });
    }
};
