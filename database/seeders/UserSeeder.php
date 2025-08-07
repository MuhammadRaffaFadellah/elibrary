<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::where('name', 'super_admin')->first();

        User::Create([
            'name'      => 'Muhammad Raffa Fadellah',
            'username'  => 'Yukha',
            'email'     => 'superadmin@gmail.com',
            'password'  => bcrypt('password123'),
            'role_id'   => $superAdminRole->id,
        ]);
    }
}
