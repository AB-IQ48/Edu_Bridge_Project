<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->after('id')->nullable()->constrained('roles');
        });

        // Default existing users to student role (id = 1)
        DB::table('users')->whereNull('role_id')->update(['role_id' => 1]);

        DB::statement('ALTER TABLE users MODIFY role_id BIGINT UNSIGNED NOT NULL');

        // Drop legacy columns if they exist (from previous user_type/company migration)
        if (Schema::hasColumn('users', 'user_type')) {
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
    }
};
