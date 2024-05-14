<?php

use App\Models\ClientAdvertisement;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_advertisement_masters',
            function (Blueprint $table) {
                $table->id();

                $table->foreignIdFor(User::class)
                    ->comment('Мастер который купил доступ')
                    ->constrained()
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

                $table->foreignIdFor(ClientAdvertisement::class)
                    ->comment('Объявление к которому покупал доступ')
                    ->constrained()
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

                $table->decimal('price', 12)
                    ->nullable()
                    ->comment('По какой цене');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_advertisement_masters');
    }

};
