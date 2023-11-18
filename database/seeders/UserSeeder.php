<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'diksjadoel',
            'email'=>'diksjadoel526@gmail.com',
            'password'=> Hash::make(12345678),
            'user_user_roles_id'=>1
        ]);
    }
}
