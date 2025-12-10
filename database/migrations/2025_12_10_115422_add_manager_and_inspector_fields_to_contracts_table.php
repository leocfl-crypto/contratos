<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->string('manager', 255)->nullable()->after('total');
            $table->string('deputy_manager', 255)->nullable()->after('manager');
            $table->string('inspector', 255)->nullable()->after('deputy_manager');
            $table->string('deputy_inspector', 255)->nullable()->after('inspector');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn(['manager', 'deputy_manager', 'inspector', 'deputy_inspector']);
        });
    }
};
