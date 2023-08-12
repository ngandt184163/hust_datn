<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Bảo Hiếu';
        $user->email = 'hieu@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Ánh Hồng';
        $user->email = 'hong@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935901086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Cẩm Li';
        $user->email = 'li@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Lan Anh';
        $user->email = 'anh@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Thùy Dung';
        $user->email = 'dung@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Minh Đạt';
        $user->email = 'dat@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Ngọc Chính';
        $user->email = 'chinh@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Lệ Quyên';
        $user->email = 'quyen@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Đức Bạch';
        $user->email = 'bach@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();

        $user = new User;
        $user->name = 'Tiến Đức';
        $user->email = 'duc@gmail.com';
        $user->password = bcrypt('000000');
        $user->phone = '0935271086';
        $user->status = 2;
        $user->created_at = Carbon::now();
        $user->save();
    }
}
