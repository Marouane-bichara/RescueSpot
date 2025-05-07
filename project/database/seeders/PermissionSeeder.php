<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $permissions = [
            'view_dashboard',
            'report_animal',
            'view_reported_animals',
            'view_animal_detail',
            'request_adoption',
            'manage_adoption_requests',
            'create_shelter_profile',
            'update_animal_status',
            'see_shelter_animals',
            'send_contact_message',
            'manage_user_profile',
            'access_admin_panel',
            'validate_or_reject_adoption',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
