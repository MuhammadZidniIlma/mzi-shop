<?php

namespace Database\Seeders;

use App\Models\BannerDiscount;
use App\Models\Discount;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discount::create([
            'name_discount' => 'Testing Discount',
            'persentase_discount' => 10,
            'amount_discount' => 10000,
            'start_date' => now(),
            'expiration_date' => now(),
        ]);

        BannerDiscount::create([
            'discount_id' => 1,
        ]);
    }
}
