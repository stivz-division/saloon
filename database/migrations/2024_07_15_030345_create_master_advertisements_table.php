<?php

use App\Models\Animal;
use App\Models\Breed;
use App\Models\MasterAdvertisement;
use App\Models\PetWeight;
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
        Schema::create('master_advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->comment('Название объявления');

            $table->date('start_at')
                ->comment('Период услуги с')
                ->nullable();

            $table->date('end_at')
                ->comment('Период услуги по')
                ->nullable();

            $table->text('description')
                ->comment('Описание объявления');

            $table->decimal('price', 12)
                ->default(0);

            $table->boolean('status')
                ->comment('Активно?')
                ->default(true);

            $table->timestamps();
        });

        Schema::create('master_advertisement_locations',
            function (Blueprint $table) {
                $table->foreignIdFor(MasterAdvertisement::class)
                    ->comment('Объявление')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreignIdFor(YandexLocation::class)
                    ->comment('Локация')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->primary([
                    'master_advertisement_id', 'yandex_location_id',
                ]);
            });

        Schema::create('master_advertisement_animals',
            function (Blueprint $table) {
                $table->foreignIdFor(MasterAdvertisement::class)
                    ->comment('Объявление')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreignIdFor(Animal::class)
                    ->comment('Тип животного с которым работает')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->primary([
                    'master_advertisement_id', 'animal_id',
                ]);
            });

        Schema::create('master_advertisement_pet_weights',
            function (Blueprint $table) {
                $table->foreignIdFor(MasterAdvertisement::class)
                    ->comment('Объявление')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreignIdFor(PetWeight::class)
                    ->comment('Вес животного')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->primary([
                    'master_advertisement_id', 'pet_weight_id',
                ]);
            });

        Schema::create('master_advertisement_breeds',
            function (Blueprint $table) {
                $table->foreignIdFor(MasterAdvertisement::class)
                    ->comment('Объявление')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreignIdFor(Breed::class)
                    ->comment('Порода животного')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->primary([
                    'master_advertisement_id', 'breed_id',
                ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_advertisement_breeds');
        Schema::dropIfExists('master_advertisement_pet_weights');
        Schema::dropIfExists('master_advertisement_animals');
        Schema::dropIfExists('master_advertisement_locations');
        Schema::dropIfExists('master_advertisements');
    }

};
