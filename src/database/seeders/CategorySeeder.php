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
        DB::table('sound_categories')->insert([
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
                'name' => '洋楽ポップス'
            ],
            [
                'name' => 'メロコア'
            ],
            [
                'name' => 'メタル'
            ],
            [
                'name' => 'ニューエイジ'
            ],
            [
                'name' => 'ヴィジュアル系'
            ],
            [
                'name' => 'EDM'
            ],
            [
                'name' => 'HIPHOP'
            ],
            [
                'name' => 'レゲエ'
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
            ],
            [
                'name' => '管楽器',
            ],
            [
                'name' => '弦楽器',
            ],
            [
                'name' => '和楽器',
            ],
            [
                'name' => 'ドラム・パーカッション',
            ],
            [
                'name' => 'ボーカル・声楽',
            ],
            [
                'name' => 'ギター',
            ],
            [
                'name' => 'ベース',
            ],
            [
                'name' => 'ウクレレ',
            ],
            [
                'name' => 'その他楽器',
            ]
            ]);

            DB::table('secondary_categories')->insert([
                [
                    'name' => 'ピアノ',
                    'primary_category_id' => 1
                ],
                [
                    'name' => 'キーボード・シンセサイザー',
                    'primary_category_id' => 1
                ],
                [
                    'name' => 'エレクトーン',
                    'primary_category_id' => 1
                ],
                [
                    'name' => 'チェンバロ',
                    'primary_category_id' => 1
                ],
                [
                    'name' => 'その他鍵盤楽器',
                    'primary_category_id' => 1
                ],
                [
                    'name' => 'サクソフォン',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'トランペット',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'フルート',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'ホルン',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'トロンボーン',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'クラリネット',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'オーボエ',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'ユーフォニアム',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'その他管楽器',
                    'primary_category_id' => 2
                ],
                [
                    'name' => 'ヴァイオリン',
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'ヴィオラ',
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'チェロ',
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'コントラバス',
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'ハープ',
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'マンドリン',
                    'primary_category_id' => 3
                ],
                [
                    'name' => 'その他弦楽器',
                    'primary_category_id' => 3
                ],
                [
                    'name' => '三線',
                    'primary_category_id' => 4
                ],
                [
                    'name' => '三味線',
                    'primary_category_id' => 4
                ],
                [
                    'name' => '琴',
                    'primary_category_id' => 4
                ],
                [
                    'name' => '篠笛',
                    'primary_category_id' => 4
                ],
                [
                    'name' => '和太鼓',
                    'primary_category_id' => 4
                ],
                [
                    'name' => 'その他和楽器',
                    'primary_category_id' => 4
                ],
                [
                    'name' => 'ドラム',
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'ティンパニ',
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'カホン',
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'ボンゴ',
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'その他パーカッション',
                    'primary_category_id' => 5
                ],
                [
                    'name' => 'ボーカル',
                    'primary_category_id' => 6
                ],
                [
                    'name' => '声楽',
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'ゴスペル',
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'ラップ',
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'ボイスパーカッション',
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'その他ボーカル・声楽',
                    'primary_category_id' => 6
                ],
                [
                    'name' => 'エレクトリックギター',
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'アコースティックギター',
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'クラシックギター',
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'フラメンコギター',
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'その他ギター',
                    'primary_category_id' => 7
                ],
                [
                    'name' => 'エレクトリックベース',
                    'primary_category_id' => 8
                ],
                [
                    'name' => 'アコースティックベース',
                    'primary_category_id' => 8
                ],
                [
                    'name' => 'ウッドベース',
                    'primary_category_id' => 8
                ],
                [
                    'name' => 'その他ベース',
                    'primary_category_id' => 8
                ],
                [
                    'name' => 'ウクレレ',
                    'primary_category_id' => 9
                ],
                [
                    'name' => 'アコーディオン',
                    'primary_category_id' => 10
                ],
                [
                    'name' => 'ピアニカ・鍵盤ハーモニカ',
                    'primary_category_id' => 10
                ],
                [
                    'name' => 'オカリナ',
                    'primary_category_id' => 10
                ],
                [
                    'name' => 'ハーモニカ・ブルースハープ',
                    'primary_category_id' => 10
                ],
                [
                    'name' => 'リコーダー',
                    'primary_category_id' => 10
                ],
                [
                    'name' => '鍵盤打楽器',
                    'primary_category_id' => 10
                ],
                ]);
    }
}
