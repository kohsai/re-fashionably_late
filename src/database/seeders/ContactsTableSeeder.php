<?php

// このコードは、Laravel のシーダーファイルで、contacts テーブルにダミーデータを挿入する処理を定義している。
// 名前空間: Database\Seeders 名前空間を指定。
namespace Database\Seeders;

// ↓  インポート: App\Models\Contact モデルと Illuminate\Database\Seeder クラスをインポート
use App\Models\Contact;
use Illuminate\Database\Seeder;

// ↓  ContactsTableSeeder クラス: Seeder クラスを継承したクラスで、シーダー処理を定義。
class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // ↓  run メソッド: シーダーを実行する際に呼ばれるメソッド。このメソッド内で、contacts テーブルにダミーデータを挿入する。
    public function run()
    {
        //   ↓  Contact::factory()->count(35)->create(): Contact モデルのファクトリーを使用して、35 件のダミーデータを生成し、データベースに保存する。
        Contact::factory()->count(35)->create();
    }
}
