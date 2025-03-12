<?php

// ↓  このコードは、Laravel フレームワークにおいて、データベースの構造を変更するためのマイグレーションファイルの最初の部分。具体的には、contacts テーブルを作成するための準備をしている。
// ↓  名前空間の宣言: 使用するクラスがどの名前空間にあるかを指定している。

// ↓  データベースの構造を変更するための基本クラス
use Illuminate\Database\Migrations\Migration;

// ↓  テーブルの構造を定義するためのブループリントクラス
use Illuminate\Database\Schema\Blueprint;

// ↓  データベーススキーマを操作するためのファサード
use Illuminate\Support\Facades\Schema;


// ↓  マイグレーションクラスの定義: CreateContactsTable という名前のクラスを定義している。このクラスは、Migration クラスを継承している。このクラス内で、データベースの変更処理を実装する。
class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    //  ↓  up メソッド: マイグレーションを実行する際に呼ばれるメソッド。このメソッド内でテーブルの作成処理を行う。
    public function up()
    {
        // ↓  Schema::create('contacts', function (Blueprint $table) { ... }): contacts という名前のテーブルを作成。
        Schema::create('contacts', function (Blueprint $table) {
            //    ↓  テーブルの主キーとなる id カラムを作成
            $table->id();

            // ↓  外部キーとして category_id カラムを作成し、categories テーブルの id カラムを参照する。また、親レコードが削除された際に子レコードも削除されるようにカスケード削除を設定。
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            //  ↓  それぞれ、first_name, last_name, email, tell, address, building という文字列型のカラムを作成する。
            $table->string('first_name');
            $table->string('last_name');
            // ↓  gender という小さな整数型のカラムを作成
            $table->tinyInteger('gender');

            $table->string('email');
            $table->string('tell');
            $table->string('address');
            $table->string('building');

            // ↓  detail というテキスト型のカラムを作成
            $table->text('detail');

            // ↓  created_at と updated_at というタイムスタンプのカラムを作成
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // ↓  down メソッド: マイグレーションをロールバックする際に呼ばれるメソッド。このメソッド内でテーブルを削除する。
    public function down()
    {
        // ↓  contacts テーブルが存在する場合に削除する。
        Schema::dropIfExists('contacts');
    }
    // まとめ
    // このコードは、contacts テーブルを作成するためのマイグレーション処理を定義している。テーブルには、カテゴリID、氏名、性別、メールアドレス、電話番号、住所、建物名、詳細、作成日時、更新日時のカラムが含まれる。また、category_id カラムは、categories テーブルへの外部キーとして設定されている。

    // ポイント
    // foreignId メソッドを使って、外部キーを簡単に定義できる。
    // cascadeOnDelete オプションを使用することで、親レコードが削除された際に子レコードも自動的に削除される。
    // up メソッドと down メソッドは、データベースの変更を管理するための重要なメソッドである。
}
