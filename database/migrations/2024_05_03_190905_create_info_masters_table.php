<?php

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
        Schema::create('info_masters', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->text('about')
                ->comment('О себе')
                ->nullable();

            $table->text('breeds')
                ->comment('Породы с которыми работает')
                ->nullable();

            $table->boolean('is_veterinarian')
                ->comment('Ветеринар?')
                ->default(false);

            $table->boolean('is_delivering_pet')
                ->comment('Доставляю питомца?')
                ->default(false);

            $table->boolean('is_home_check_out')
                ->comment('Выезд на дом?')
                ->default(false);

            $table->boolean('is_at_home')
                ->comment('У себя?')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_masters');
    }

};
