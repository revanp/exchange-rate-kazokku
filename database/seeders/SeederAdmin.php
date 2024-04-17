<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class SeederAdmin extends Seeder
{
    public function run(): void
    {
        $getAdminRole = Role::where('name', 'Admin')->first();

        User::create([
            'role_id' => $getAdminRole->id,
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('P@ssw0rd'),
        ]);
    }
}
