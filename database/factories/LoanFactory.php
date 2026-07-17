<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $loan = fake()->randomFloat(2, 0, 10000000);
        return [
            'user_id' => User::factory(),
            'amount_loaned' => $loan,
            'remaining_loan' => $loan,
            'status' => 'belum_lunas',
            'loan_date' => Carbon::now()->format('Y-m-d'),
        ];
    }
}
