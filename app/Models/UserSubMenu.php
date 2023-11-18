<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_sub_menus_title',
        'user_sub_menus_url',
        'user_sub_menus_icons',
        'user_sub_menus_is_active',
        'user_sub_menus_user_menu_id'
    ];

    public function userSubMenus() {
        return $this->belongsTo(UserMenu::class,'user_sub_menus_user_menu_id');
    }
}
