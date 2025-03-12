<?php

// 概要
// このコードは、Laravel のデータベースシーダーで使用される User モデル用のファクトリークラスを定義している。ファクトリークラスは、テストデータやデータベースの初期化時に、ダミーユーザーデータを作成するための便利な仕組みを提供する。

// ↓  名前空間: Database\Factories 名前空間を指定している。
namespace Database\Factories;

// インポート: Illuminate\Database\Eloquent\Factories\Factory クラスと Illuminate\Support\Str クラスをインポート。
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


// ↓  Factory クラスを継承した UserFactory クラスを定義
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    // ↓  definition メソッド: ファクトリーが生成するデフォルトのユーザーデータの定義を記述する。
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            //      ↑
            // name: Faker ライブラリを使用してランダムな名前を生成する。
            // email: Faker ライブラリを使用してユニークなメールアドレスを生成する。
            // email_verified_at: 現在の日時を設定する。
            // password: ハッシュ化されたパスワードのダミー値を設定する。実際のアプリケーションでは、パスワードハッシュ関数を使用する必要がある。
            // remember_token: ランダムな 10 文字のトークンを生成する。

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // ↓ unverified メソッド:ユーザーのメールアドレスが未検証の状態を定義する。
    public function unverified()
    {
        // ↓  state メソッドを使用して、デフォルトの定義をオーバーライドし、email_verified_at を null に設定する。
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
    //     まとめ
    // このコードは、User モデル用のファクトリークラスを作成し、ダミーユーザーデータの生成方法を定義している。このファクトリークラスは、テストデータの作成やデータベースの初期化に利用される。

    // ポイント
    // faker ライブラリを使用して、さまざまな種類のダミーデータを作成できる。
    // state メソッドを使用して、ファクトリー定義をカスタマイズできる。
    // パスワードのハッシュ化は、実際のアプリケーションでは適切なハッシュ関数を使用する必要がある。
}
