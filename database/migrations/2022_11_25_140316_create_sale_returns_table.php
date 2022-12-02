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
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_num')->unique();
            $table->date('date')->default(now());
            $table->foreignIdFor(\App\Models\Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('rate',9,2);
            $table->integer('qty');
            $table->decimal('amount',9,2);
            $table->string('unit_name');
//            $table->decimal('cost_rate',9,2);
            $table->enum('type',['CHECKED','MANUAL','COMPLETED'])->default('MANUAL');
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
        Schema::dropIfExists('sale_returns');
    }
};
