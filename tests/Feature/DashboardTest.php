<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, get, assertDatabaseHas, assertDatabaseMissing};

it('can\'t display admin dashboard if not login', function () {
    get(route('admin.index'))->assertRedirect(route('login'));
});

it('can display the admin dashboard', function () {
    $admin = User::factory()->admin()->create();

    $response = actingAs($admin)->get(route('admin.index'));
    $response->assertStatus(200);
});

it('can display the create member form', function () {
    $admin = User::factory()->admin()->create();

    $response = actingAs($admin)->get(route('admin.create'));
    $response->assertStatus(200);
});

it('can store a new member', function () {
    $admin = User::factory()->admin()->create();

    $response = actingAs($admin)->post(route('admin.store'), [
        'name' => 'aldiansyah',
        'phone_number' => '085712345678',
        'password' => 'aldiansyah1234',
    ]);

    assertDatabaseHas('users', [
        'name' => 'aldiansyah',
    ]);

    $response->assertRedirect(route('admin.index'));
});

it('can display the edit member form', function () {
    $admin = User::factory()->admin()->create();
    $member = User::factory()->create();

    $response = actingAs($admin)->get(route('admin.edit', $member->id));
    $response->assertStatus(200);
});

it('can update a member', function () {
    $admin = User::factory()->admin()->create();
    $member = User::factory()->create();

    $response = actingAs($admin)->put(route('admin.update', $member), [
        'name' => 'aldiansyah',
        'phone_number' => '0808080808',
    ]);

    assertDatabaseHas('users', [
        'id' => $member->id,
        'name' => 'aldiansyah',
        'phone_number' => '0808080808',
    ]);

    $response->assertRedirect(route('admin.index'));
});

it('can delete a member', function () {
    $admin = User::factory()->admin()->create();
    $member = User::factory()->create();

    $response = actingAs($admin)->delete(route('admin.destroy', $member->id));
    assertDatabaseMissing('users', [
        'id' => $member->id,
    ]);
    $response->assertRedirect(route('admin.index'));
});
