<?php

use App\Models\AdvertisementTopTariff;
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
            $table->foreignIdFor(
                AdvertisementTopTariff::class
            )
                ->after('price')
                ->comment('Активный тариф поднятия в ТОП')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamp('set_top_tariff_at')
                ->comment('Дата установки тарифа поднятия')
                ->nullable()
                ->after('advertisement_top_tariff_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_advertisements', function (Blueprint $table) {
            //
        });
    }

};
