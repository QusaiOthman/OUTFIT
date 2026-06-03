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
        Schema::table('settings', function (Blueprint $table) {
            $table->decimal('premium_customer_minimum', 10, 2)->default(500);

            $table->decimal('vip_customer_minimum', 10, 2)->default(2000);

            $table->decimal('elite_customer_minimum', 10, 2)->default(5000);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([

                'premium_customer_minimum',

                'vip_customer_minimum',

                'elite_customer_minimum'

            ]);
        });
    }
};
