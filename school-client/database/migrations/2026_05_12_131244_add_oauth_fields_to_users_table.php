<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'provider')) {
                $table->string('provider')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'provider_id')) {
                $table->string('provider_id')->nullable()->after('provider');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('provider_id');
            }
            if (Schema::hasColumn('users', 'password')) {
                $table->string('password')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['provider', 'provider_id', 'avatar'];
            $existing = array_filter($columns, fn($col) => Schema::hasColumn('users', $col));

            if (!empty($existing)) {
                $table->dropColumn($existing);
            }

            if (Schema::hasColumn('users', 'password')) {
                $table->string('password')->nullable(false)->change();
            }
        });
    }
};
