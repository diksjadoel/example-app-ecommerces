<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_menus_title',
        'user_menus_user_role_id'
    ];

    public function user_Role() {
        return $this->belongsTo(UserRole::class,'user_menus_user_role_id');
    }

    public function userSubMenu() {
        return $this->hasMany(UserSubMenu::class,'user_sub_menus_user_menu_id');
    }

    public function usermenuhaspermission() {
        return $this->hasMany(UserMenuHasPermission::class,'user_menu_has_permissions_user_menus_id');
    }
}
