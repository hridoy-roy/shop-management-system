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
            $table->date('date')->default(now());
            $table->foreignIdFor(\App\Models\Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('product_in')->default(0);
            $table->integer('product_in')->default(0);
            $table->decimal('price',9,2);
            $table->decimal('total',9,2);
            $table->decimal('cost',9,2);
            $table->decimal('final',9,2);
//            $table->integer('tr_no');
//            $table->enum('tr_no',[]);
//            $table->integer('lot_no');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
