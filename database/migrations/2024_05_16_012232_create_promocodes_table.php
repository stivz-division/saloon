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
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();

            $table->string('type')
                ->comment('Тип промокода');

            $table->foreignIdFor(User::class)
                ->comment('Пользователь который использовал промокод')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('code')
                ->comment('Промокод')
                ->unique();

            $table->boolean('is_active')
                ->comment('Активен?')
                ->default(false);

            $table->boolean('is_used')
                ->comment('Использован?')
                ->default(false);

            $table->timestamp('used_at')
                ->comment('Когда использован?')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocodes');
    }

};
