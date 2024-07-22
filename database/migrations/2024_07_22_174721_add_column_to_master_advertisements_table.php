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
        Schema::table('master_advertisements', function (Blueprint $table) {
            $table->timestamp('published_at')
                ->comment('Дата публикации')
                ->after('status');
            
            $table->timestamp('end_published_at')
                ->comment('Дата окончания публикации')
                ->after('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_advertisements', function (Blueprint $table) {
            $table->dropColumn('published_at');
            $table->dropColumn('end_published_at');
        });
    }

};
