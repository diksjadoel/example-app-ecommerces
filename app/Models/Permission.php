<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_name'
    ];

    public function userpermission() {
        return $this->hasMany(UserMenuHasPermission::class,'user_menu_has_permissions_user_permissions_id');
    }
}
