<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserMenuHasPermission;
class UserMenuHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserMenuHasPermission::create([
            'user_menu_has_permissions_user_permissions_id'=>3,
            'user_menu_has_permissions_user_menus_id'=>4
        ]);
    }
}
