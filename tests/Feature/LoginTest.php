<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\{assertAuthenticatedAs, get, post, delete, assertDatabaseHas, assertDatabaseMissing};

it('can display the signin form', function () {
    $response = get(route('login'));

    $response->assertStatus(200);
});

it('can signin with admin credentials', function () {
    $admin = User::create([
        'name' => 'admin koperasi',
        'phone_number' => '085712341234',
        'password' => Hash::make('admin1234'),
        'role' => 'admin',
    ]);

    $response = post('/login', [
        'phone_number' => '085712341234',
        'password' => 'admin1234',
    ]);

    assertAuthenticatedAs($admin);
    $response->assertRedirect(route('admin.index'));
});
