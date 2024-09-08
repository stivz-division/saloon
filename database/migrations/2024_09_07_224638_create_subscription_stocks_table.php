<?php

use App\Models\Subscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Subscription::class)
                ->comment('На какой тариф акция')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->text('description')
                ->comment('Какое-то описание акции')
                ->nullable();

            $table->string('type')
                ->comment('Тип акции для определения процента: Процент или Цена');

            $table->unsignedSmallInteger('percent')
                ->comment('Процент скидки');

            $table->decimal('price', 12)
                ->comment('Цена со скидкой');

            $table->timestamp('start_at')
                ->comment('Дата начала акции');

            $table->timestamp('end_at')
                ->comment('Дата окончания акции');

            $table->boolean('is_active')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }

};
