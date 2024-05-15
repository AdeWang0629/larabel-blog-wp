<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BigCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('big_category')->insert([
            [
                'category' => 'テイクアウト／デリ',
            ],
            [
                'category' => '冷凍／チルド／レトルト',
            ],
            [
                'category' => 'インスタント',
            ],
            [
                'category' => '缶詰',
            ],
            [
                'category' => '食材',
            ],
            [
                'category' => '調味料',
            ],
            [
                'category' => '酒',
            ],
            [
                'category' => '飲料水',
            ],
            [
                'category' => '菓子',
            ],
        ]);
    }
}
