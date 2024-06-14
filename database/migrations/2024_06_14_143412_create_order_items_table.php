<?php

use App\Models\Order;
use App\Models\ProductVariant;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(ProductVariant::class);

            // we store the product information at the time of purchase because the product may change or be deleted in the future
            $table->unsignedInteger('price');
            $table->unsignedInteger('quantity');
            $table->string('name');
            $table->string('description');

            $table->integer('amount_total')->default(0);
            $table->integer('amount_subtotal')->default(0);
            $table->integer('amount_tax')->default(0);
            $table->integer('amount_discount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
