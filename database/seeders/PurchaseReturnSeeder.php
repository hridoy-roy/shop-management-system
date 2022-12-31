<?php

namespace Database\Seeders;

use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PurchaseReturn::factory(20)
            ->has(PurchaseReturnDetail::factory()->count(rand(1,4)), 'purchaseReturnDetails')
            ->create();
    }
}
