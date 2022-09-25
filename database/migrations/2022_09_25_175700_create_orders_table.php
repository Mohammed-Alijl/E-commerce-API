<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('color_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('size_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('address_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('status_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('shippingType_id')->constrained('shipping_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
