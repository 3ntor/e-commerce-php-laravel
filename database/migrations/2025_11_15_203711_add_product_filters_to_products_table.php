<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('price');
            $table->integer('sales_count')->default(0)->after('is_featured');
            $table->boolean('is_new')->default(true)->after('sales_count');
            $table->decimal('old_price', 10, 2)->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'sales_count', 'is_new', 'old_price']);
        });
    }
};