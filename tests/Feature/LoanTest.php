<?php

use App\Models\User;
use App\Models\Loan;
use Carbon\Carbon;

use function Pest\Laravel\{actingAs, assertDatabaseHas, assertDatabaseMissing};

it('can display loan page', function () {
    $admin = User::factory()->admin()->create();

    $response = actingAs($admin)->get(route('loans.index'));
    $response->assertStatus(200);
});

it('can display the create loan form', function () {
    $admin = User::factory()->admin()->create();

    $response = actingAs($admin)->get(route('loans.create'));
    $response->assertStatus(200);
});

it('can store a new loan', function () {
    $admin = User::factory()->admin()->create();
    $member = User::factory()->create();

    $response = actingAs($admin)->post(route('loans.store'), [
        'user_id' => $member->id,
        'amount_loaned' => 2500000.00,
        'loan_date' => Carbon::now()->format('Y-m-d'),
    ]);

    assertDatabaseHas('loans', [
        'user_id' => $member->id,
        'amount_loaned' => 2500000.00,
    ]);

    $response->assertRedirect(route('loans.index'));
});

it('can display the edit loan form', function () {
    $admin = User::factory()->admin()->create();
    $loan = Loan::factory()->create();

    $response = actingAs($admin)->get(route('loans.edit', $loan->id));
    $response->assertStatus(200);
});

it('can update a loan', function () {
    $admin = User::factory()->admin()->create();
    $loan = Loan::factory()->create();

    $response = actingAs($admin)->put(route('loans.update', $loan), [
        'amount_loaned' => 5000000.00,
        'loan_date' => $loan->loan_date->format('Y-m-d'),
    ]);
    $response->assertSessionHasNoErrors();

    assertDatabaseHas('loans', [
        'id' => $loan->id,
        'user_id' => $loan->user_id,
        'amount_loaned' => 5000000.00,
    ]);

    $response->assertRedirect(route('loans.index'));
});

it('can delete a loan', function () {
    $admin = User::factory()->admin()->create();
    $loan = Loan::factory()->create();

    $response = actingAs($admin)->delete(route('loans.destroy', $loan->id));
    assertDatabaseMissing('loans', [
        'id' => $loan->id,
        'user_id' => $loan->user_id,
    ]);

    $response->assertRedirect(route('loans.index'));
});
