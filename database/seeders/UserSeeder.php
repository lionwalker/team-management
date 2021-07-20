<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [
                'email' => 'admin@admin.com'
            ],
            [
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin@123')
            ]
        );
    }
}
