<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userType = new UserType;
        $userType->name = 'USER';
        $userType->description = 'User người dùng';
        $userType->save();

        $userType = new UserType;
        $userType->name = 'ADMIN';
        $userType->description = 'Admin hệ thống';
        $userType->save();
    }
}
