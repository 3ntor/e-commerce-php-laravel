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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('company')->nullable();
        $table->string('address');
        $table->string('city');
        $table->string('country');
        $table->string('zipcode');
        $table->string('mobile');
        $table->string('email');
        $table->text('notes')->nullable();
        $table->string('shipping_method');
        $table->string('payment_method');
        $table->decimal('subtotal', 10, 2);
        $table->decimal('shipping', 10, 2)->default(0);
        $table->decimal('total', 10, 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
