<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->insert([
            'login' => 'admin',
            'name' => 'Админ',
            'email' => 'foxrent@mail.ru',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 1,
            'remember_token' => null,
        ]);
    }
}
