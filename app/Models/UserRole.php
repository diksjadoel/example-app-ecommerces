<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserMenu;
class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_roles_name'
    ];

    public function user_menus() {
        return $this->hasMany(UserMenu::class,'user_menus_user_role_id');
    }
    public function user_role() {
        return $this->hasMany(User::class,'user_user_roles_id');
    }
}
