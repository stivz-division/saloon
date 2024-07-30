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
        Schema::table('advertisement_top_tariffs', function (Blueprint $table) {
            $table->decimal('price', 12)
                ->after('minutes')
                ->comment('Цена тарифа')
                ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisement_top_tariffs', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }

};
