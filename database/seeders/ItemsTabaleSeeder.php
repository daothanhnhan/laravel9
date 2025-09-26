<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// add
// use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ItemsTabaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $fake  = Faker\Factory::create();
        $limit = 10;

        // for ($i = 0; $i < $limit; $i++){
        //     DB::table('news')->insert([
        //         'title' => $fake->name,
        //         'created_at' => date("Y-m-d H:i:s"),
        //         'updated_at' => date("Y-m-d H:i:s"),
        //         'email' => $fake->unique->email,
        //         'description' => $fake->sentence(15)
        //     ]);
        // }

        for ($i = 0; $i < $limit; $i++){
            DB::table('news')->insert([
                'title' => fake()->name(),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'email' => fake()->unique->email,
                'description' => fake()->sentence(15)
            ]);
        }
    }
}
