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
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')->default('pelanggan');
        }
        if (!Schema::hasColumn('users', 'hp')) {
            $table->string('hp')->nullable();
        }
        if (!Schema::hasColumn('users', 'alamat')) {
            $table->string('alamat')->nullable();
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'hp', 'alamat']);
    });
}
};
