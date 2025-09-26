<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_types')->insert([
            'name' => 'Trang',
            'type' => 'pages',
            'state' => '1',
            'model' => 'Page',
        ]);

        DB::table('menu_types')->insert([
            'name' => 'Danh mục tin tức',
            'type' => 'news_cats',
            'state' => '1',
            'model' => 'NewsCat',
        ]);

        DB::table('menu_types')->insert([
            'name' => 'Tin tức',
            'type' => 'posts',
            'state' => '1',
            'model' => 'Post',
        ]);

        DB::table('menu_types')->insert([
            'name' => 'Danh mục sản phẩm',
            'type' => 'product_cats',
            'state' => '1',
            'model' => 'ProductCat',
        ]);

        DB::table('menu_types')->insert([
            'name' => 'Sản phẩm',
            'type' => 'products',
            'state' => '1',
            'model' => 'Product',
        ]);

        DB::table('menu_types')->insert([
            'name' => 'Khác',
            'type' => 'menu_specials',
            'state' => '1',
            'model' => 'MenuSpecial',
        ]);
    }
}
