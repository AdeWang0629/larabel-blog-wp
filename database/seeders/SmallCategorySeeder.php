<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmallCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('small_category')->insert([
            [
                'category' => '米飯',
            ],
            [
                'category' => '麺類',
            ],
            [
                'category' => 'パン',
            ],
            [
                'category' => '弁当',
            ],
            [
                'category' => '惣菜',
            ],
            [
                'category' => 'おつまみ',
            ],
            [
                'category' => '盛り合わせ／御重',
            ],
            [
                'category' => 'ソース（パスタ／カレー）',
            ],
            [
                'category' => '米／麺',
            ],
            [
                'category' => '肉',
            ],
            [
                'category' => '魚',
            ],
            [
                'category' => '野菜',
            ],
            [
                'category' => '果物',
            ],
            [
                'category' => '豆・ナッツ（コーヒー／納豆）',
            ],
            [
                'category' => '乳製品（牛乳／チーズ／バター／クリーム）',
            ],
            [
                'category' => '粉類（小麦粉／片栗粉）',
            ],
            [
                'category' => '食用油',
            ],
            [
                'category' => '塩',
            ],
            [
                'category' => '砂糖',
            ],
            [
                'category' => '味噌',
            ],
            [
                'category' => '醤油',
            ],
            [
                'category' => 'ソース／たれ',
            ],
            [
                'category' => '酢',
            ],
            [
                'category' => 'マヨネーズ',
            ],
            [
                'category' => 'ケチャップ',
            ],
            [
                'category' => 'ドレッシング',
            ],
            [
                'category' => 'めんつゆ',
            ],
            [
                'category' => '出汁（鍋つゆ／中華出汁）',
            ],
            [
                'category' => 'ルー（カレー／シチュー）',
            ],
            [
                'category' => 'スパイス（胡椒／わさび／七味／マスタード）',
            ],
            [
                'category' => 'ビール',
            ],
            [
                'category' => '日本酒',
            ],
            [
                'category' => 'ワイン',
            ],
            [
                'category' => '焼酎',
            ],
            [
                'category' => 'ウィスキー／ブランデー',
            ],
            [
                'category' => 'リキュール',
            ],
            [
                'category' => '日本茶',
            ],
            [
                'category' => 'コーヒー／ココア',
            ],
            [
                'category' => '紅茶',
            ],
            [
                'category' => '中国茶',
            ],
            [
                'category' => 'ハーブティー',
            ],
            [
                'category' => '果実飲料',
            ],
            [
                'category' => '炭酸飲料',
            ],
            [
                'category' => '乳酸飲料',
            ],
            [
                'category' => '野菜ジュース',
            ],
            [
                'category' => '健康飲料／スポーツ・ドリンク',
            ],
            [
                'category' => '水',
            ],
            [
                'category' => '洋菓子（ケーキ／チョコレート／ドーナッツ／プリン）',
            ],
            [
                'category' => '和菓子（団子／おしるこ／せんべい）',
            ],
            [
                'category' => 'アイスクリーム／氷',
            ],
            [
                'category' => '飴',
            ],
            [
                'category' => 'ガム／グミ',
            ],
            [
                'category' => 'スナック',
            ],
            [
                'category' => '駄菓子',
            ]
        ]);
    }
}
