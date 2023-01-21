<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'J-POP'
            ],
            [
                'name' => 'K-POP'
            ],
            [
                'name' => 'クラシック'
            ],
            [
                'name' => 'Jazz'
            ],
            [
                'name' => '邦楽ロック'
            ],
            [
                'name' => '洋楽ロック'
            ],
            [
                'name' => 'メタル'
            ],
            [
                'name' => 'ヴィジュアル系'
            ],
            [
                'name' => 'R&B'
            ],
            [
                'name' => 'アニソン'
            ],
            [
                'name' => '歌謡曲/演歌'
            ]
        ]);
        DB::table('primary_categories')->insert([
            [
                'name' => '鍵盤楽器',
                'sort_order' => 1,
            ],
            [
                'name' => '管楽器',
                'sort_order' => 2,
            ],
            [
                'name' => '弦楽器',
                'sort_order' => 3,
            ],
            [
                'name' => '和楽器',
                'sort_order' => 4,
            ],
            [
                'name' => 'ドラム・パーカッション',
                'sort_order' => 5,
            ],
            [
                'name' => 'ボーカル・声楽',
                'sort_order' => 6,
            ],
            [
                'name' => 'ギター',
                'sort_order' => 7,
            ],
            [
                'name' => 'ベース',
                'sort_order' => 8,
            ],
            [
                'name' => 'ウクレレ',
                'sort_order' => 9,
            ],
            [
                'name' => 'その他楽器',
                'sort_order' => 10,
            ]
            ]);

            DB::table('secondary_categories')->insert([
                [
                    'name' => 'ピアノ',
                    'sort_order' => 1,
                    'primary_category_id' => 1
                ],
                [
                    'name' => 'キーボード・シンセサイザー',
                    'sort_order' => 2,
                    'primary_category_id' => 1
                ],
                [
                    'name' => 'エレクトーン',
                    'sort_order' => 3,
                    'primary_category_id' => 1
                ],
                [
                    'name' => 'サクソフォン',
                    'sort_order' => 4,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'トランペット',
                    'sort_order' => 5,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'フルート',
                    'sort_order' => 6,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'ホルン',
                    'sort_order' => 7,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'トロンボーン',
                    'sort_order' => 8,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'クラリネット',
                    'sort_order' => 9,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'オーボエ',
                    'sort_order' => 10,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'ユーフォニアム',
                    'sort_order' => 11,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'その他管楽器',
                    'sort_order' => 12,
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'ヴァイオリン',
                    'sort_order' => 13,
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'ヴィオラ',
                    'sort_order' => 14,
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'チェロ',
                    'sort_order' => 15,
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'コントラバス',
                    'sort_order' => 16,
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'ハープ',
                    'sort_order' => 17,
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'マンドリン',
                    'sort_order' => 18,
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'その他弦楽器',
                    'sort_order' => 19,
                    'primary_category_id' => 3
                ],
                [
                    'name' => '三線',
                    'sort_order' => 20,
                    'primary_category_id' => 4
                ],
                [
                    'name' => '三味線',
                    'sort_order' => 21,
                    'primary_category_id' => 4
                ],
                [
                    'name' => '琴',
                    'sort_order' => 22,
                    'primary_category_id' => 4
                ],
                [
                    'name' => '篠笛',
                    'sort_order' => 23,
                    'primary_category_id' => 4
                ],
                [
                    'name' => '和太鼓',
                    'sort_order' => 24,
                    'primary_category_id' => 4
                ],
                [
                    'name' => 'その他和楽器',
                    'sort_order' => 25,
                    'primary_category_id' => 4
                ],
                [
                    'name' => 'ドラム',
                    'sort_order' => 26,
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'カホン',
                    'sort_order' => 27,
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'ボンゴ',
                    'sort_order' => 28,
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'その他パーカッション',
                    'sort_order' => 29,
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'ボーカル',
                    'sort_order' => 30,
                    'primary_category_id' => 6
                ],
                [
                    'name' => '声楽',
                    'sort_order' => 31,
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'ゴスペル',
                    'sort_order' => 32,
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'ラップ',
                    'sort_order' => 33,
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'ボイスパーカッション',
                    'sort_order' => 34,
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'エレクトリックギター',
                    'sort_order' => 35,
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'アコースティックギター',
                    'sort_order' => 36,
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'クラシックギター',
                    'sort_order' => 37,
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'フラメンコギター',
                    'sort_order' => 38,
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'エレクトリックベース',
                    'sort_order' => 39,
                    'primary_category_id' => 8
                ],
                [
                    'name' => 'ウッドベース',
                    'sort_order' => 40,
                    'primary_category_id' => 8
                ],
                [
                    'name' => 'ウクレレ',
                    'sort_order' => 41,
                    'primary_category_id' => 9
                ],
                [
                    'name' => 'アコーディオン',
                    'sort_order' => 42,
                    'primary_category_id' => 10
                ],
                [
                    'name' => 'ピアニカ・鍵盤ハーモニカ',
                    'sort_order' => 43,
                    'primary_category_id' => 10
                ],
                [
                    'name' => 'オカリナ',
                    'sort_order' => 44,
                    'primary_category_id' => 10
                ],
                [
                    'name' => 'ハーモニカ・ブルースハープ',
                    'sort_order' => 45,
                    'primary_category_id' => 10
                ],
                [
                    'name' => 'リコーダー',
                    'sort_order' => 46,
                    'primary_category_id' => 10
                ],
                [
                    'name' => '鍵盤打楽器',
                    'sort_order' => 47,
                    'primary_category_id' => 10
                ],
                ]);
    }
}
