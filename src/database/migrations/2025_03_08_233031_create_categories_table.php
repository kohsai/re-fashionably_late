<?php

//  ↓  このコードは、Laravel のマイグレーションファイルで、categories テーブルを作成する処理を定義している。マイグレーションは、データベースのスキーマ（テーブル構造）を変更するための仕組み。

// 名前空間: Database\Migrations 名前空間を指定している。
// インポート: Migration, Blueprint, Schema クラスをインポート。
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// ↓  CreateCategoriesTable クラス: Migration クラスを継承したクラスで、マイグレーション処理を定義する。
class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //       ↓ up メソッド: マイグレーションを実行する際に呼ばれるメソッド。
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->timestamps();
            //  ↑  Schema::create('categories', ...): categories という名前のテーブルを作成する。
            // $table->id(): テーブルの主キーとなる id カラムを作成する。
            // $table->string('content'): content という名前の文字列型のカラムを作成。
            // $table->timestamps(): created_at と updated_at というタイムスタンプのカラムを作成。
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // ↓  down メソッド: マイグレーションをロールバックする際に呼ばれるメソッド。
    public function down()
    {
        // ↓  Schema::dropIfExists('categories'): categories テーブルが存在する場合に削除する。
        Schema::dropIfExists('categories');

        //    まとめ
        // このコードはcategories テーブルを作成するためのマイグレーションファイルで、データベースのスキーマ変更をバージョン管理するのに役立つもの。
        // up メソッドでテーブルの作成を行い、down メソッドでテーブルの削除を行うことで、データベースの変更を管理することができる。
    }
}
