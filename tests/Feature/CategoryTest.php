<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can create category', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/categories', [
            '_token' => csrf_token(),
            'name' => 'Food',
            'type' => 'expense',
            'color' => '#FF0000',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('categories', [
        'name' => 'Food',
        'type' => 'expense',
        'color' => '#FF0000',
        'user_id' => $user->id,
    ]);
});

test('user can view categories', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get('/categories');

    $response->assertStatus(200);
    $response->assertSee($category->name);
});

test('user can update category', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->put("/categories/{$category->id}", [
            '_token' => csrf_token(),
            'name' => 'Updated Food',
            'type' => 'income',
            'color' => '#00FF00',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Updated Food',
        'type' => 'income',
        'color' => '#00FF00',
    ]);
});

test('user can delete category', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->delete("/categories/{$category->id}", [
            '_token' => csrf_token(),
        ])
        ->assertRedirect();

    $this->assertDatabaseMissing('categories', [
        'id' => $category->id,
    ]);
});

test('user cannot access other users category', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user1->id]);

    $this->actingAs($user2)
        ->get("/categories/{$category->id}")
        ->assertForbidden();
});
