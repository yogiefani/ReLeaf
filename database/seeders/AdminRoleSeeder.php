<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role admin ada
        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        // Buat beberapa admin yang akan handle pengantaran
        $admins = [
            [
                'name' => 'Community Admin 1',
                'email' => 'admin1@releaf.com',
                'password' => Hash::make('password'),
                'coins' => 0
            ],
            [
                'name' => 'Community Admin 2',
                'email' => 'admin2@releaf.com',
                'password' => Hash::make('password'),
                'coins' => 0
            ]
        ];

        foreach ($admins as $adminData) {
            $admin = User::firstOrCreate(
                ['email' => $adminData['email']],
                $adminData
            );

            // Assign role admin
            if (!$admin->roles()->where('name', 'admin')->exists()) {
                $admin->roles()->attach($adminRole->id);
            }
        }

        $this->command->info('Admin users created successfully!');
        $this->command->info('Email: admin1@releaf.com, Password: password');
        $this->command->info('Email: admin2@releaf.com, Password: password');
    }
}
