<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pet_types', function (Blueprint $table) {
            $table->id();
            $table->string('pet_type');
            $table->timestamps();
        });

        DB::table('pet_types')->insert($this->getNewEntries(self::NEW_TYPES));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_types');
    }

    public function getNewEntries($newEntries): array
    {
        foreach ($newEntries as $key => $newEntry) {
            $newEntries[$key]['created_at'] = now();
            $newEntries[$key]['updated_at'] = now();
        }
        return $newEntries;
    }

    const NEW_TYPES = [
        ['pet_type' => 'Собака'],
        ['pet_type' => 'Кошка'],
    ];
};
