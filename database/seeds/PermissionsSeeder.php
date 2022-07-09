<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
        [
            'name' => 'user-create',
            'display_name' => 'User Create',
            'description' => 'Create New User'
        ],
        [
            'name' => 'user-edit',
            'display_name' => 'User Edit',
            'description' => 'Edit User'
        ],
        [
            'name' => 'user-delete',
            'display_name' => 'User Delete',
            'description' => 'Delete User'
        ],
        [
            'name' => 'users',
            'display_name' => 'Users',
            'description' => 'Users Page'
        ],
        [
            'name' => 'permissions',
            'display_name' => 'permissions',
            'description' => 'permissions'
        ],
        [
            'name' => 'roles',
            'display_name' => 'Roles',
            'description' => 'Roles'
        ],
        [
            'name' => 'filemanager',
            'display_name' => 'File Manager',
            'description' => 'File Manager'
        ],
        [
            'name' => 'user-profile-view',
            'display_name' => 'Account Settings / User Profile',
            'description' => 'Display User Profile'
        ],
        [
            'name' => 'modulebuilder_menu',
            'display_name' => 'CRUD / Menu',
            'description' => 'Display Menu of Module Builder'
        ],
        [
            'name' => 'modulebuilder_modules',
            'display_name' => 'CRUD / Modules',
            'description' => 'Display All Modules of Module Builder'
        ],
        [
            'name' => 'general-settings',
            'display_name' => 'General Settings',
            'description' => 'Display General Settings'
        ]    
       ]);
    }
}
