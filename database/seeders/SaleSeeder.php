<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::factory(20)
            ->has(SaleDetail::factory()->count(rand(1,5)))
            ->create();
    }
}
