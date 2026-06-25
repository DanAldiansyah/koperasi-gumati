<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Saving;
use Carbon\Carbon;

class SavingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Saving::create([
            'user_id' => 1,
            'type' => 'pokok',
            'amount' => 50000.00,
            'transaction_date' => Carbon::now(),
            'note' => "Simpanan Pokok"
        ]);

        Saving::create([
            'user_id' => 1,
            'type' => 'wajib',
            'amount' => 2000000.00,
            'transaction_date' => Carbon::now(),
        ]);
        
    }
}
