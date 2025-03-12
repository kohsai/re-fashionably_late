<?php


// ↓  このコードは、Laravel のデータベースシーダーのメインクラスである DatabaseSeeder を定義している。このクラスは、他のシーダークラスを呼び出すことで、データベースの初期化を行なっている。
// ↓ 名前空間: Database\Seeders 名前空間を指定。
namespace Database\Seeders;

// ↓  インポート: Illuminate\Database\Seeder クラスをインポート。
use Illuminate\Database\Seeder;

// ↓  DatabaseSeeder クラス: Seeder クラスを継承したクラスで、データベースの初期化処理を定義している。
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // ↓  run メソッド: シーダーを実行する際に呼ばれるメソッド。このメソッド内で、他のシーダークラスを呼び出している。
    public function run()
    {
        // ↓  $this->call([...]): 指定されたシーダークラスを実行している。この例では、CategoriesTableSeeder と ContactsTableSeeder を呼び出している。
        $this->call([
            CategoriesTableSeeder::class,
            ContactsTableSeeder::class
        ]);
        // まとめ
        // このコードは、データベースの初期化を行うためのメインシーダー。他のシーダークラスを呼び出すことで、データベースに必要なデータを挿入することができる。

        // ポイント
        // DatabaseSeeder クラスは他のシーダークラスの呼び出しを行う為の起点となる。
        // $this->call() メソッドを使用して、他のシーダークラスを実行できる。

        // 補足
        // 実際のアプリケーションでは、複数のシーダークラスを作成して、データベースの初期化を段階的に行うことが一般的。
        // シーダーの実行は、php artisan db:seed コマンドで行う。
    }
}
