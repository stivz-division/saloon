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
        Schema::create('dog_weight_ranges', function (Blueprint $table) {
            $table->id();
            $table->string('range_name');
            $table->timestamps();
        });

        DB::table('dog_weight_ranges')->insert($this->getNewEntries(self::NEW_WEIGHT_RANGES));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dog_weight_ranges');
    }

    public function getNewEntries($newEntries): array
    {
        foreach ($newEntries as $key => $newEntry) {
            $newEntries[$key]['created_at'] = now();
            $newEntries[$key]['updated_at'] = now();
        }
        return $newEntries;
    }

    const NEW_WEIGHT_RANGES = [
        ['range_name' => 'до 6 кг'],
        ['range_name' => '6 - 12 кг'],
        ['range_name' => '12 - 24 кг'],
        ['range_name' => '24 - 40 кг'],
        ['range_name' => '40+ кг'],
    ];
};
