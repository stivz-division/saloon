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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->comment('Название');

            $table->unsignedInteger('advertisement_count')
                ->comment('Количество объявлений');

            $table->unsignedInteger('published_days')
                ->comment('Количество дней размещения');

            $table->decimal('price', 12)
                ->comment('Цена подписки');

            $table->boolean('status')
                ->comment('Подписка активна?')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }

};
