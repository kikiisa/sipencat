<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'nQsVz@example.com',
            'role' => 'admin',
            'status' => 'active',
            'password' => bcrypt('admin123'),

       ]);

       User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'user',
            'name' => 'User',
            'email' => 'IYqkW@example.com',
            'role' => 'user',
            'status' => 'active',
            'password' => bcrypt('users123'),
       ]);
    }
}
