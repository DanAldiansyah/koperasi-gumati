<?php

use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('can display the pay loan form', function () {
    $admin = User::factory()->admin()->create();
    $loan = Loan::factory()->create();

    $response = actingAs($admin)->get(route('loans.pay', $loan->id));
    $response->assertStatus(200);
});

it('can store a payment loan', function () {
    $admin = User::factory()->admin()->create();
    $loan = Loan::factory()->create([
        'amount_loaned' => 2500000.00,
    ]);

    $response = actingAs($admin)->post(route('loans.storePayment', $loan), [
        'amount_paid' => 1000000.00,
        'payment_date' => Carbon::now()->format('Y-m-d'),
    ]);

    assertDatabaseHas('loan_payments', [
        'loan_id' => $loan->id,
        'amount_paid' => 1000000.00,
    ]);

    $response->assertRedirect(route('loans.index'));
});
