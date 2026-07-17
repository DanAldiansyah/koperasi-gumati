<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Saving;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Saving>
 */
class SavingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => 'wajib',
            'amount' => 2500000.00,
            'transaction_date' => Carbon::now()->format('Y-m-d'),
        ];
    }
}
