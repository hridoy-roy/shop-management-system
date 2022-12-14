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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Sale::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(\App\Models\Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('rate',9,2);
            $table->integer('qty');
            $table->decimal('amount',9,2);
            $table->string('unit_name')->nullable();
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
        Schema::dropIfExists('sale_details');
    }
};
