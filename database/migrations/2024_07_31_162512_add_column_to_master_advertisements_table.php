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
        Schema::table('master_advertisements', function (Blueprint $table) {
            $table->timestamp('top_at')
                ->after('set_top_tariff_at')
                ->nullable()
                ->comment('Когда было поднято.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_advertisements', function (Blueprint $table) {
            $table->dropColumn('top_at');
        });
    }

};
