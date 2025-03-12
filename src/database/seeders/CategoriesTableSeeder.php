<?php

// このコードは、Laravel のシーダーファイルで、categories テーブルに初期データを挿入する処理を定義している。シーダーは、データベースにテストデータや初期データを挿入するための仕組み。
// ↓ Database\Seeders 名前空間を指定している。
namespace Database\Seeders;

// インポート：Illuminate\Database\Seeder クラスと Illuminate\Support\Facades\DB クラスをインポート。
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


// CategoriesTableSeeder クラス: Seeder クラスを継承したクラスで、シーダー処理を定義する。
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // ↓  run メソッド: シーダーを実行する際に呼ばれるメソッド。このメソッド内で、categories テーブルにデータを挿入する。
    public function run()
    {
        $contents = [
            "商品のお届けについて",
            "商品の交換について",
            "商品トラブル",
            "ショップへのお問い合わせ",
            "その他"
        ];
        // ↓  foreach ループ:$contents 配列の各要素に対してcategories テーブルにデータを挿入する。
        foreach ($contents as $content) {
            DB::table('categories')->insert([
                'content' => $content,
                // ↑  DB::table('categories')->insert([...]): categories テーブルにデータを挿入するクエリを実行。
            ]);
        }
    }
}
