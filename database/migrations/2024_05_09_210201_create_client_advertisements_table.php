<?php

use App\Models\Pet;
use App\Models\User;
use App\Models\YandexLocation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_advertisements', function (Blueprint $table) {
            $table->id();

            $table->uuid();

            $table->foreignIdFor(User::class)
                ->comment('Автор')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(Pet::class)
                ->comment('Питомец')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(YandexLocation::class)
                ->comment('Локация получения услуги')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->text('description')
                ->comment('Описание нужной услуги');

            $table->timestamp('datetime_service_at')
                ->comment('Желаемая дата получения услуги')
                ->nullable();

            $table->boolean('is_payment')
                ->comment('Оплачен?')
                ->default(false);

            $table->boolean('is_published')
                ->comment('Публикуется?')
                ->default(false);

            $table->timestamp('published_at')
                ->comment('Дата начала публикации')
                ->nullable();

            $table->timestamp('published_end_at')
                ->comment('Дата окончания публикации')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_advertisements');
    }

};
