<?php

// database/seeders/RolePermissionSeeder.php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Get roles by their ID
        $adminRole = Role::find(1);   // Admin role
        $userRole = Role::find(2);    // User role
        $shelterRole = Role::find(3); // Shelter role

        // Get permissions
        $permissions = Permission::all();

        // Assign all permissions to the admin role
        foreach ($permissions as $permission) {
            $adminRole->permissions()->attach($permission->id);
        }

        // Assign specific permissions to the user role
        $userPermissions = Permission::whereIn('name', [
            'report_animal', 
            'adopt_animal', 
            'view_animal_detail',
            'request_adoption',
            'manage_user_profile',
        ])->get();

        foreach ($userPermissions as $permission) {
            $userRole->permissions()->attach($permission->id);
        }

        // Assign specific permissions to the shelter role
        $shelterPermissions = Permission::whereIn('name', [
            'view_shelter_animals', 
            'manage_shelter_profile',
            'view_reported_animals',
            'view_animal_detail',
            'manage_adoption_requests',
            'create_shelter_profile',
            'update_animal_status',
            'see_shelter_animals',
            'validate_or_reject_adoption'
        ])->get();

        foreach ($shelterPermissions as $permission) {
            $shelterRole->permissions()->attach($permission->id);
        }
    }
}
