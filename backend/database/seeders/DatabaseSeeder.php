<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '12345678',
            'mobile' => '87654321',
            'password' => Hash::make(12345678),
            'address' => '66 Loops And Technology, Johar Town',
            'designation' => 'Administration',
        ]);
        $user = User::find(1);
        $role = Role::create(['name' => 'Admin']);
        $user->assignRole(1);
    }
}
