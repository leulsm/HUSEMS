<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\ExamCoordinator;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ExamCoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::create([
            'name' => 'Leiul Mekonnen',
            'email' => 'leiul@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Assign a role to the user
        $role = Role::findByName('examCoordinator');
        $user->assignRole($role);

        // Create an admin record associated with the user
        $examCoordinator = ExamCoordinator::create([
            'user_id' => $user->id,
            'first_name' => 'Leiul',
            'last_name' => 'Mekonnen',
            'email' => $user->email,
            'phone' => '0904768500',
        ]);
    }
}
