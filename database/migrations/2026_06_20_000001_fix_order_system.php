<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_type')->nullable()->after('payment_status');
            $table->text('shipping_address')->nullable()->after('payment_type');
            $table->string('shipping_phone')->nullable()->after('shipping_address');
            $table->string('shipping_name')->nullable()->after('shipping_phone');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'shipping_address', 'shipping_phone', 'shipping_name']);
        });
    }
};
