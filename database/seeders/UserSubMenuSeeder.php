<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSubMenu;
class UserSubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSubMenu::create([
            'user_sub_menus_title'=>'Inventory Create',
            'user_sub_menus_url'=>'inventory/create',
            'user_sub_menus_is_active'=>1,
            'user_sub_menus_user_menu_id'=>4
        ]);
    }
}
