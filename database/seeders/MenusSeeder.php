<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu;
        $menu->name = 'Chia sẻ kinh nghiệm';
        $menu->description = 'Bài viết có nội dung chia sẻ các kinh nghiệm chăm sóc thú cưng, đồ ăn, chăm sóc sức khỏe, ...';
        $menu->slug = 'chia-se-kinh-nghiem';
        $menu->status = 1;
        $menu->save();

        $menu = new Menu;
        $menu->name = 'Hỏi đáp';
        $menu->description = 'Hỏi đáp về các vấn đề liên quan đến thú cưng.';
        $menu->slug = 'hoi-dap';
        $menu->status = 1;
        $menu->save();

        $menu = new Menu;
        $menu->name = 'Cho nhận';
        $menu->description = 'Mọi người đăng bài cho những con thú cưng của mình k nuôi nữa, muốn tìm chủ nhân mới cho ẻm.';
        $menu->slug = 'cho-nhan';
        $menu->status = 1;
        $menu->save();
    }
}
