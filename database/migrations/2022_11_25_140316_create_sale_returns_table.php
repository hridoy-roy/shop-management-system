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
            $table->string('sale_return_num')->unique();
            $table->foreignIdFor(\App\Models\Customer::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->date('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('amount',9,2);
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
        Schema::dropIfExists('sale_returns');
    }
};
