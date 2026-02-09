<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('super')->default(false)->after('password');
            $table->timestamp('last_login')->nullable()->after('super');
            $table->json('roles')->nullable()->after('last_login');
            $table->json('permissions')->nullable()->after('roles');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['super', 'last_login', 'roles', 'permissions']);
        });
    }
};
