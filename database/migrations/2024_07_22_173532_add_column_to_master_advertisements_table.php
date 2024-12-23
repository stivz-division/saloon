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
        Schema::table('master_advertisements', function (Blueprint $table) {
            $table->foreignIdFor(User::class)
                ->after('id')
                ->comment('Автор')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_advertisements', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropColumn('user_id');
        });
    }

};
