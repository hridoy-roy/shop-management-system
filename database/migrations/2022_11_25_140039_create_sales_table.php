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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Customer::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('sale_num')->unique();
            $table->date('date')->default(now());
            $table->decimal('amount',9,2);
            $table->decimal('discount',9,2)->default(0);
            $table->enum('type',App\Utility\Utility::$type)->default('Cash');
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
        Schema::dropIfExists('sales');
    }
};
