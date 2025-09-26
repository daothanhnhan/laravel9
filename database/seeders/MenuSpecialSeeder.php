<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSpecialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_specials')->insert([
            'name' => 'Trang chủ',
            'link' => '/',
            'state' => '1',
        ]);

        DB::table('menu_specials')->insert([
            'name' => 'Tất cả tin tức',
            'link' => '/tat-ca-tin-tuc',
            'state' => '1',
        ]);

        DB::table('menu_specials')->insert([
            'name' => 'Tất cả sản phẩm',
            'link' => '/tat-ca-san-pham',
            'state' => '1',
        ]);

        DB::table('menu_specials')->insert([
            'name' => 'Liên hệ',
            'link' => '/lien-he',
            'state' => '1',
        ]);

        DB::table('menu_specials')->insert([
            'name' => 'Đăng ký',
            'link' => '/dang-ky',
            'state' => '0',
        ]);

        DB::table('menu_specials')->insert([
            'name' => 'Đăng nhập',
            'link' => '/dang-nhap',
            'state' => '0',
        ]);
    }
}
