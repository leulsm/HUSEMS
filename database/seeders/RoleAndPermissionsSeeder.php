<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create role
        $studentRole = Role::create(['name' => 'invigilator']);

        $adminRole = Role::create(['name' => 'admin']);
        $examCoordinatorRole = Role::create(['name' => 'examCoordinator']);
        $studentRole = Role::create(['name' => 'student']);


        // Create permissions
        $manageUsersPermission = Permission::create(['name' => 'manage users']);
        $manageExamCoordinatorPermission = Permission::create(['name' => 'manage examCoordinator']);
        $manageStudentPermission = Permission::create(['name' => 'manage student']);
        $manageSystemSettingsPermission = Permission::create(['name' => 'manage system settings']);
        $viewReportsPermission = Permission::create(['name' => 'view reports']);

        // Assign permissions to roles
        $adminRole->syncPermissions([
            $manageUsersPermission,
            $manageExamCoordinatorPermission,
            $manageStudentPermission,
            $manageSystemSettingsPermission,
            $viewReportsPermission,
        ]);

        $examCoordinatorRole->syncPermissions([
            $manageExamCoordinatorPermission,
            $manageStudentPermission,
        ]);

        $studentRole->syncPermissions([
            $manageStudentPermission,
        ]);
    }
}
