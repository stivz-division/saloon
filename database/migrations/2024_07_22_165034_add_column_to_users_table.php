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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Subscription::class)
                ->nullable()
                ->after('account_type')
                ->comment('Текущая подписка')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamp('subscription_start_at')
                ->after('subscription_id')
                ->nullable();

            $table->timestamp('subscription_end_at')
                ->after('subscription_start_at')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_subscription_foreign');
            $table->dropColumn('subscription_start_at');
            $table->dropColumn('subscription_end_at');
            $table->dropColumn('subscription_id');
        });
    }

};
