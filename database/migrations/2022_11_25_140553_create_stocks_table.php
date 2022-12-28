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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreignIdFor(\App\Models\Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('product_in')->default(0);
            $table->integer('product_out')->default(0);
            $table->decimal('price',9,2);
            $table->decimal('amount',9,2);
            $table->integer('tr_no');
            $table->string('tr_from');
            $table->integer('lot_no')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->morphs('stocksable');
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
        Schema::dropIfExists('stocks');
    }
};
