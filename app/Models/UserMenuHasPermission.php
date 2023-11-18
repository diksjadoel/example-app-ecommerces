<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenuHasPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_menu_has_permissions_user_permissions_id',
        'user_menu_has_permissions_user_menus_id'
    ];

    public function userpermissions() {
        return $this->belongsTo(Permission::class,'user_menu_has_permissions_user_permissions_id');
    }

    public function usermenuhaspermissions() {
        return $this->belongsTo(UserMenu::class,'user_menu_has_permissions_user_menus_id');
    }
}
