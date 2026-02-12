<?php

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can create transaction', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->post('/transactions', [
            '_token' => csrf_token(),
            'category_id' => $category->id,
            'amount' => 100.00,
            'description' => 'Test transaction',
            'transaction_date' => now()->toDateString(),
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('transactions', [
        'category_id' => $category->id,
        'amount' => 100.00,
        'description' => 'Test transaction',
        'user_id' => $user->id,
    ]);
});

test('user can view transactions', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user->id]);
    $transaction = Transaction::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $response = $this->actingAs($user)->get('/transactions');

    $response->assertStatus(200);
    $response->assertSee($transaction->amount);
});

test('user can update transaction', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user->id]);
    $transaction = Transaction::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $this->actingAs($user)
        ->put("/transactions/{$transaction->id}", [
            '_token' => csrf_token(),
            'category_id' => $category->id,
            'amount' => 200.00,
            'description' => 'Updated transaction',
            'transaction_date' => now()->toDateString(),
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('transactions', [
        'id' => $transaction->id,
        'amount' => 200.00,
        'description' => 'Updated transaction',
    ]);
});

test('user can delete transaction', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user->id]);
    $transaction = Transaction::factory()->create([
        'user_id' => $user->id,
        'category_id' => $category->id,
    ]);

    $this->actingAs($user)
        ->delete("/transactions/{$transaction->id}", [
            '_token' => csrf_token(),
        ])
        ->assertRedirect();

    $this->assertDatabaseMissing('transactions', [
        'id' => $transaction->id,
    ]);
});

test('user cannot access other users transaction', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user1->id]);
    $transaction = Transaction::factory()->create([
        'user_id' => $user1->id,
        'category_id' => $category->id,
    ]);

    $this->actingAs($user2)
        ->get("/transactions/{$transaction->id}")
        ->assertForbidden();
});
