<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@fptic.com',
            'password' => Hash::make('password')
        ]);
        $user2 = User::create([
            'name' => 'Test User',
            'email' => 'teste@fptic.com',
            'password' => Hash::make('password')
        ]);
        $role = Role::create(['name' => 'Super Admin']);
        $user->assignRole($role);
    


    }
}
