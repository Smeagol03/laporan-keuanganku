<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo User',
                'password' => bcrypt('password'),
            ]
        );

        $this->command->info('Test User Created:');
        $this->command->info('Email: demo@example.com');
        $this->command->info('Password: password');

        $categories = [
            ['name' => 'Gaji', 'type' => 'income', 'color' => '#22c55e'],
            ['name' => 'Freelance', 'type' => 'income', 'color' => '#10b981'],
            ['name' => 'Investasi', 'type' => 'income', 'color' => '#14b8a6'],
            ['name' => 'Makanan', 'type' => 'expense', 'color' => '#ef4444'],
            ['name' => 'Transportasi', 'type' => 'expense', 'color' => '#f97316'],
            ['name' => 'Belanja', 'type' => 'expense', 'color' => '#eab308'],
            ['name' => 'Utilitas', 'type' => 'expense', 'color' => '#8b5cf6'],
            ['name' => 'Hiburan', 'type' => 'expense', 'color' => '#ec4899'],
        ];

        foreach ($categories as $category) {
            $user->categories()->updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }

        $this->command->info('Categories seeded successfully!');

        $this->command->info('Demo account ready for testing.');
    }
}
