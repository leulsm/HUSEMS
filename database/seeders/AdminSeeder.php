<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'Leul Solomon',
            'email' => 'leulsolm7@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Assign a role to the user
        $role = Role::findByName('admin');
        $user->assignRole($role);

        // Create an admin record associated with the user
        $admin = Admin::create([
            'user_id' => $user->id,
            'first_name' => 'Leul',
            'last_name' => 'Solomon',
            'email' => $user->email,
            'phone' => '0932599064',
        ]);
    }
}
