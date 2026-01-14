<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'systemsuperadmin',
            'email' => 'systemsuperadmin@gmail.com',
            'password' => Hash::make(12345678),
            'user_type'=>2
        ]);
        Role::create([
            'name'=>'systemsuperadmin'
        ]);
        $user->assignRole('systemsuperadmin');
    }
}
