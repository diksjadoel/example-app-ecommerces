<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserMenu;
class UserMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserMenu::create([
                'user_menus_title'=>'Inventory Management',
                'user_menus_user_role_id'=>1
        ]);
    }
}
