<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'title' => 'Loại web',
            'description' => 'Mô tả',
            'keyword' => 'từ khóa',
            'intro' => 'Giới thiệu',

            'logo' => '',
            'icon' => '',
            'banner_1' => '',
            'banner_2' => '',
            'banner_3' => '',
            'banner_4' => '',
            'banner_5' => '',

            'content_home_1' => '',
            'content_home_2' => '',
            'content_home_3' => '',
            'content_home_4' => '',
            'content_home_5' => '',
            'content_home_6' => '',
            'content_home_7' => '',
            'content_home_8' => '',
            'content_home_9' => '',
            'content_home_10' => '',

            'embed_code_header' => '<meta name="tuan" content="header" />',
            'embed_code_footer' => '<meta name="tuan" content="footer" />',
        ]);
    }
}
