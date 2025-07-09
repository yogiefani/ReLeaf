<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Membuat Super Admin ---
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@airbook.com',
            'password' => Hash::make('superadmin123'), 
            'coins' => 1000,
        ]);
        $superAdmin->roles()->attach($superAdminRole);

        // --- Membuat User Biasa ---
        $userRole = Role::where('name', 'User')->first(); 

        $emma = User::create([
            'name' => 'Emma',
            'email' => 'emma@example.com',
            'password' => Hash::make('password'),
            'coins' => 50,
        ]);
        $emma->roles()->attach($userRole); 
        $emma->addresses()->create([
            'label' => 'Home',
            'full_address' => 'Jl. Raya Rambutan, Condong Catur, Depok, Sleman, Yogyakarta',
            'phone_number' => '+628127898752',
            'is_current' => true,
        ]);

        $nanami = User::create([
            'name' => 'Nanami',
            'email' => 'nanami@example.com',
            'password' => Hash::make('password'),
            'coins' => 150,
        ]);
        $nanami->roles()->attach($userRole); 
        $nanami->addresses()->create([
            'label' => 'Office - Nanami',
            'full_address' => 'Jl. Malioboro No. 123, Yogyakarta City Center',
            'phone_number' => '+628127898752',
            'is_current' => true,
        ]);
         $nanami->addresses()->create([
            'label' => 'Parents House',
            'full_address' => 'Jl. Kaliurang KM 5, Sleman, Yogyakarta',
            'phone_number' => '+628123456789',
            'is_current' => false,
        ]);
    }
}
