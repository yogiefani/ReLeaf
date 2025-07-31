<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('delivery_status', ['pending', 'preparing', 'picked_up', 'in_transit', 'delivered', 'completed'])
                ->default('pending')
                ->after('status');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->after('delivery_status');
            $table->text('delivery_notes')->nullable()->after('assigned_to');
            $table->timestamp('picked_up_at')->nullable()->after('delivery_notes');
            $table->timestamp('delivered_at')->nullable()->after('picked_up_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('assigned_to');
            $table->dropColumn(['delivery_status', 'delivery_notes', 'picked_up_at', 'delivered_at']);
        });
    }
};
