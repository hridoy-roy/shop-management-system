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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('leaser_name');
            $table->date('date')->default(now());
            $table->decimal('debit',9,2)->default(0);
            $table->decimal('credit',9,2)->default(0);
            $table->text('note')->nullable();
            $table->string('transaction_num');
            $table->string('transaction_name');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->morphs('accountable');
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
        Schema::dropIfExists('accounts');
    }
};
