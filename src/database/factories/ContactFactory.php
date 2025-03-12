<?php

// ↓  概要
// このコードは、Laravel のデータベースシーダーで使用される Contact モデル用のファクトリークラスを定義している。ファクトリークラスは、テストデータやデータベースの初期化時に、ダミーデータを作成するための便利な仕組みを提供する。

// ※ 名前空間（namespace）とは、各要素に一意の異なる名前をつけなければ識別できない範囲のこと。例えば、通常同じファイルに同じクラスや関数名、定数名が存在することはできないが、名前空間を使用することにより、関連するクラスや、インターフェイス、関数、定数などをグループ化することが可能となる。
// そのため、名前空間を指定しておけば自分が作ったクラスが、サードパーティのクラスや関数などと名前が衝突することを防ぐことができる。

// 名前空間: Database\Factories 名前空間を指定しています。
namespace Database\Factories;

// ↓  インポート: App\Models\Contact モデルと Illuminate\Database\Eloquent\Factories\Factory クラスをインポート
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;


// ↓  Factory クラスを継承した ContactFactory クラスを定義
class ContactFactory extends Factory
{
    // このファクトリーが生成するモデルを Contact モデルに設定する。
    protected $model = Contact::class;

    // ↓  definition メソッド: ファクトリーが生成するデータの定義を記述。
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'first_name' => $this->faker->lastName(),
            'last_name' => $this->faker->firstName(),
            'gender' => $this->faker->randomElement([1, 2, 3]),
            'email' => $this->faker->safeEmail(),
            'tell' => $this->faker->phoneNumber(),
            'address' => $this->faker->city() . $this->faker->streetAddress(),
            'building' => $this->faker->secondaryAddress(),
            'detail' => $this->faker->text(120),
            //   ↑  フィールド: 各フィールドにダミーデータを生成するための faker メソッドを使用している。
            // category_id: 1から5までのランダムな整数
            // first_name: ランダムな姓
            // last_name: ランダムな名
            // gender: 1, 2, 3 のいずれかのランダムな整数 (おそらく性別を表す)
            // email: ランダムなメールアドレス
            // tell: ランダムな電話番号
            // address: ランダムな市と住所
            // building: ランダムな建物名
            // detail: 120文字のランダムなテキスト

            // ↑   まとめ
            // このコードは、Contact モデル用のファクトリークラスを作成し、ダミーデータの生成方法を定義しているもの。このファクトリークラスは、データベースシーダーなどで利用され、テストデータや初期データの作成に役立つ。

            // ポイント
            // faker ライブラリを使用して、さまざまな種類のダミーデータを生成できる。
            // ファクトリークラスはテストデータの作成やデータベースの初期化を効率化する。
        ];
    }
}
