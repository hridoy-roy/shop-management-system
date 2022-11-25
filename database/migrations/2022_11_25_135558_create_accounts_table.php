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
//            $table->foreignIdFor(\App\Models\Ledger::class)->constrained()->cascadeOnUpdate()->nullOnDelete();
//            $table->date('date')->default(now());
//            $table->decimal('debit',9,2);
//            $table->decimal('credit',9,2);
//            $table->text('note')->nullable();
//            $table->integer('transaction_num');
//            $table->string('transaction_name');
//            $table->string('created_by')->nullable();
//            $table->string('updated_by')->nullable();
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
