<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    public function run()
    {
        Voucher::create([
            'code'          => 'SANJAI10',
            'discount_amount' => 10,
            'type'          => 'percentage',
            'start_date'    => now()->subDays(1),
            'expired_date'  => now()->addDays(7),
            'quota'         => 50,
            'status'        => 'aktif',
        ]);
    }
}