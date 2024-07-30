<?php

use App\Domain\Enum\AdvertisementTopTariffsType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advertisement_top_tariffs',
            function (Blueprint $table) {
                $table->id();

                $table->string('name')
                    ->comment('Название тарифа');

                $table->unsignedSmallInteger('count_days')
                    ->comment('Период поднятия в днях');

                $table->string('type')
                    ->comment('Тип поднятия')
                    ->default(AdvertisementTopTariffsType::Minute);

                $table->time('start_time')
                    ->comment('Время поднятия')
                    ->nullable();

                $table->unsignedInteger('minutes')
                    ->comment('Поднять в top через n минут')
                    ->nullable();

                $table->boolean('status')
                    ->default(true)
                    ->comment('Активно?');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement_top_tariffs');
    }

};
