<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account. The email and password come from the .env file
        // (ADMIN_EMAIL / ADMIN_PASSWORD), so they are never stored on GitHub.
        $password = env('ADMIN_PASSWORD');
        if (! $password) {
            $this->command?->warn('ADMIN_PASSWORD is not set in .env, so no admin account was created.');

            return;
        }

        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@ecoquest.test')],
            ['name' => 'EcoQuest Admin', 'password' => $password, 'is_admin' => true]
        );
    }
}
