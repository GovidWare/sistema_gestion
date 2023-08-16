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
        truncate('users');

        User::insert([
            [
                'name'               => 'Usuario 1',
                'email'              => 'usuario1@email.com',
                'email_verified_at'  => now(),
                'password'           => bcrypt('12345'),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'Usuario 2',
                'email'              => 'usuario2@email.com',
                'email_verified_at'  => now(),
                'password'           => bcrypt('12345'),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'Usuario 3',
                'email'              => 'usuario3@email.com',
                'email_verified_at'  => now(),
                'password'           => bcrypt('12345'),
                'created_at'         => now(),
                'updated_at'         => now(),
            ]
        ]);
    }
}
