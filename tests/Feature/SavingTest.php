<?php

use App\Models\Saving;
use App\Models\User;
use Carbon\Carbon;

use function Pest\Laravel\{actingAs, assertDatabaseHas, assertDatabaseMissing};

it('can display the saving page', function () {
    $admin = User::factory()->admin()->create();

    $response = actingAs($admin)->get(route('savings.index'));
    $response->assertStatus(200);
});

it('can display the create saving form', function () {
    $admin = User::factory()->admin()->create();

    $response = actingAs($admin)->get(route('savings.create'));
    $response->assertStatus(200);
});

it('can store a new saving', function () {
    $admin = User::factory()->admin()->create();
    $member = User::factory()->create();

    $response = actingAs($admin)->post(route('savings.store'), [
        'user_id' => $member->id,
        'type' => 'wajib',
        'amount' => 15000.00,
        'transaction_date' => Carbon::now()->format('Y-m-d'),
    ]);
    assertDatabaseHas('savings', [
        'user_id' => $member->id,
        'type' => 'wajib',
    ]);

    $response->assertRedirect(route('savings.index'));
});

it('can display the edit saving form', function () {
    $admin = User::factory()->admin()->create();
    $saving = Saving::factory()->create();

    $response = actingAs($admin)->get(route('savings.edit', $saving->id));
    $response->assertStatus(200);
});

it('can update a saving', function () {
    $admin = User::factory()->admin()->create();
    $saving = Saving::factory()->create();

    $response = actingAs($admin)->put(route('savings.update', $saving), [
        'amount' => 3000000.00,
    ]);
    assertDatabaseHas('savings', [
        'id' => $saving->id,
        'user_id' => $saving->user_id,
        'amount' => 3000000.00,
    ]);

    $response->assertRedirect(route('savings.index'));
});

it('can delete a saving', function () {
    $admin = User::factory()->admin()->create();
    $saving = Saving::factory()->create();

    $response = actingAs($admin)->delete(route('savings.destroy', $saving->id));
    assertDatabaseMissing('savings', [
        'id' => $saving->id,
    ]);

    $response->assertRedirect(route('savings.index'));
});
