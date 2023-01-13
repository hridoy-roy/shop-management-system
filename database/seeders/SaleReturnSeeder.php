<?php

namespace Database\Seeders;

use App\Models\SaleReturn;
use App\Models\SaleReturnDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SaleReturn::factory(20)
            ->has(SaleReturnDetail::factory()->count(rand(1,4)), 'saleReturnDetails')
            ->create();
    }
}
