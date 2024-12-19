<?php

use App\Models\ViewSubscription;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('info_masters', function (Blueprint $table) {
            $table->foreignIdFor(ViewSubscription::class)
                ->nullable()
                ->after('is_at_home')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('subscription_views')
                ->nullable()
                ->after('subscription_end_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('info_masters', function (Blueprint $table) {
            $table->dropForeign('info_masters_view_subscription_views_foreign');
            $table->dropColumn('view_subscription_id');
            $table->dropColumn('subscription_views');
        });
    }

};
