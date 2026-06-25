<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loan;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Loan::create([
            'user_id' => 1,
            'amount_loaned' => 10000000.00,
            'remaining_loan' => 10000000.00,
            'loan_date' => Carbon::now()->subMonth(),
            'status' => 'belum_lunas'
        ]);
    }
}
