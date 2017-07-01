<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        \DB::table('permissions')->delete();
        // Role user
        \DB::table('role_user')->delete();
        // Permission Role
        \DB::table('permission_role')->delete();

        \DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1');
        \DB::statement('ALTER TABLE role_user AUTO_INCREMENT = 1');


        \DB::statement('ALTER TABLE permission_role AUTO_INCREMENT = 1');

        DB::table('permissions')->insert([
            ['id' => 1, 'name' => 'view-dashboard', 'display_name' => 'View Dashboard', 'description' => 'Allow to view dashboard'],
            ['id' => 2, 'name' => 'view-users', 'display_name' => 'View Users', 'description' => 'Allow to view users details'],
            ['id' => 3, 'name' => 'add-user', 'display_name' => 'Add User', 'description' => 'Allow to add user details'],
            ['id' => 4, 'name' => 'edit-user', 'display_name' => 'Edit User', 'description' => 'Allow to edit user details'],
            ['id' => 5, 'name' => 'delete-user', 'display_name' => 'Delete User', 'description' => 'Allow to delete user'],
            ['id' => 6, 'name' => 'csv-import', 'display_name' => 'Csv Import', 'description' => 'Allow to csv import'],
            ['id' => 7, 'name' => 'add-role', 'display_name' => 'Add Role', 'description' => 'Allow to View role'],
            ['id' => 8, 'name' => 'edit-role', 'display_name' => 'Edit Role', 'description' => 'Allow to edit Role'],
            ['id' => 9, 'name' => 'delete-role', 'display_name' => 'Delete Role', 'description' => 'Allow to delete Role'],
            ['id' => 10, 'name' => 'view-role', 'display_name' => 'View Roles', 'description' => 'Allow to view role'],
            ['id' => 11, 'name' => 'add-permission', 'display_name' => 'Add Permission', 'description' => 'Allow to add permission'],
            ['id' => 12, 'name' => 'edit-permission', 'display_name' => 'edit Permission', 'description' => 'Allow to edit permission'],
            ['id' => 13, 'name' => 'delete-permission', 'display_name' => 'Delete Permission', 'description' => 'Allow to delete permission'],
            ['id' => 14, 'name' => 'view-activity-log', 'display_name' => 'View Activity Log', 'description' => 'Allow to view activity log'],
            ['id' => 15, 'name' => 'view-email-template', 'display_name' => 'View Email Template', 'description' => 'Allow to view email template'],
            ['id' => 16, 'name' => 'edit-email-template', 'display_name' => 'Edit Email Template', 'description' => 'Allow to edit email template'],
            ['id' => 17, 'name' => 'message-to-other-users', 'display_name' => 'Message to Other Users', 'description' => 'Allow to Message to Other Users'],
            ['id' => 18, 'name' => 'update-social-settings', 'display_name' => 'Update Social Settings', 'description' => 'Allow to update social settings'],
            ['id' => 19, 'name' => 'update-general-settings', 'display_name' => 'Update General Settings', 'description' => 'Allow to update general settings'],
            ['id' => 20, 'name' => 'update-custom-fields', 'display_name' => 'Update Custom Fields', 'description' => 'Allow to update Custom Fields'],
            ['id' => 21, 'name' => 'manage-custom-fields', 'display_name' => 'Manage Custom Fields', 'description' => 'Allow to manage Custom Fields'],
            ['id' => 22, 'name' => 'update-theme-settings', 'display_name' => 'Update Theme Settings', 'description' => 'Allow to update theme settings'],
            ['id' => 23, 'name' => 'update-mail-settings', 'display_name' => 'Update Theme Settings', 'description' => 'Allow to update theme settings'],
            ['id' => 24, 'name' => 'update-common-settings', 'display_name' => 'Update Common Settings', 'description' => 'Allow to update common settings'],
            ['id' => 25, 'name' => 'view-permission', 'display_name' => 'View Permission', 'description' => 'Allow to view permissions'],
        ]);

        \DB::table('roles')->delete();

        \DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');

        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'display_name' => 'Admin', 'description' => 'Superadmin'],
            ['id' => 2, 'name' => 'role-dashboard', 'display_name' => 'Role Dashboard', 'description' => 'user role dashboard'],
            ['id' => 3, 'name' => 'role-users', 'display_name' => 'Role Users', 'description' => 'user role role-users'],
            ['id' => 4, 'name' => 'role-roles&permissions', 'display_name' => 'Role Roles and Permissions', 'description' => 'user role roles and permissions'],
            ['id' => 5, 'name' => 'role-activity-log', 'display_name' => 'Role Activity Logs', 'description' => 'user role activity logs'],
            ['id' => 6, 'name' => 'role-email-template', 'display_name' => 'Role Email Template', 'description' => 'user role email template'],
            ['id' => 7, 'name' => 'role-messages', 'display_name' => 'Role messages', 'description' => 'user role messages'],
            ['id' => 8, 'name' => 'role-settings', 'display_name' => 'Role settings', 'description' => 'user role settings'],

        ]);


        $roles = \App\Role::all();
        $users = User::all();

        foreach($users as $user) {
            if($user->user_type == 'admin') {
                DB::table('role_user')->insert([
                    ['user_id' => $user->id, 'role_id' => 1],
                ]);
            }
            else {
                DB::table('role_user')->insert([
                    ['user_id' => $user->id, 'role_id' => $roles->random()->id],
                ]);
            }
        }

        $permissions = \App\Permission::all();

        foreach($permissions as $permission) {
            DB::table('permission_role')->insert([
                ['permission_id' => $permission->id, 'role_id' => 1],
            ]);
        }

        if (env('APP_ENV') !== 'production') {
            DB::table('permission_role')->insert([
                ['permission_id' => 1, 'role_id' => 2],
                ['permission_id' => 2, 'role_id' => 3],
                ['permission_id' => 3, 'role_id' => 3],
                ['permission_id' => 4, 'role_id' => 3],
                ['permission_id' => 5, 'role_id' => 3],
                ['permission_id' => 6, 'role_id' => 3],
                ['permission_id' => 7, 'role_id' => 4],
                ['permission_id' => 8, 'role_id' => 4],
                ['permission_id' => 9, 'role_id' => 4],
                ['permission_id' => 10, 'role_id' => 4],
                ['permission_id' => 11, 'role_id' => 4],
                ['permission_id' => 12, 'role_id' => 4],
                ['permission_id' => 13, 'role_id' => 4],
                ['permission_id' => 14, 'role_id' => 5],
                ['permission_id' => 15, 'role_id' => 6],
                ['permission_id' => 16, 'role_id' => 6],
                ['permission_id' => 17, 'role_id' => 7],
                ['permission_id' => 18, 'role_id' => 8],
                ['permission_id' => 19, 'role_id' => 8],
                ['permission_id' => 20, 'role_id' => 8],
                ['permission_id' => 21, 'role_id' => 8],
                ['permission_id' => 22, 'role_id' => 8],
                ['permission_id' => 23, 'role_id' => 8],
                ['permission_id' => 24, 'role_id' => 8],
                ['permission_id' => 25, 'role_id' => 4],
            ]);
        }
    }

}
