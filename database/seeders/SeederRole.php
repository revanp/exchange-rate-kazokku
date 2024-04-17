<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class SeederRole extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'Admin'
        ]);

        Role::create([
            'name' => 'Staff'
        ]);
    }
}
