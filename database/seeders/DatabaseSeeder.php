<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account. The email and password come from the .env file
        // (ADMIN_EMAIL / ADMIN_PASSWORD) via config/ecoquest.php, so they are never stored on GitHub.
        $password = config('ecoquest.admin.password');
        if (! $password) {
            $this->command?->warn('ADMIN_PASSWORD is not set in .env, so no admin account was created.');

            return;
        }

        User::updateOrCreate(
            ['email' => config('ecoquest.admin.email')],
            ['name' => 'EcoQuest Admin', 'password' => $password, 'is_admin' => true]
        );
    }
}
