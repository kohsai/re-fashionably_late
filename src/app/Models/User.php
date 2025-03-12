<?php

// ↓  このコードは、Laravelのユーザーモデルである App\Models\User クラスの定義を開始している。このモデルはユーザー認証、通知、APIトークンなどの機能を提供する。

// ↓  名前空間: App\Models ディレクトリに属するクラスであることを宣言している。
namespace App\Models;

// ※  トレイト(Trait)とは、複数のクラスで同じメソッドやプロパティを共有するための機能。PHPは単一継承しかサポートしていない為、その不便を軽減するために導入された模様。

// ↓  トレイトのインポート:
// HasFactory: モデルファクトリを使用できるようにする。
// Authenticatable: ユーザー認証機能を提供している。
// Notifiable: 通知機能を提供している。。
// HasApiTokens: APIトークン生成機能を提供している。
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// ↑  ※  重要なポイント
// Authenticatable トレイトは、ユーザー認証の核心となる機能を提供する。
// Notifiable トレイトは、メールやデータベース通知などの機能を実装するための基盤となる。
// HasApiTokens トレイトは、API認証のためのトークンを生成・管理するための機能を提供する。



// ↓  このクラスは、ユーザーの情報をデータベースに保存し、認証、通知、APIトークンなどの機能を提供している。

// クラス定義: User クラスは、Authenticatable クラスを継承する。これによりユーザー認証機能が利用可能になる。

// ↓  トレイトの利用: HasApiTokens, HasFactory, Notifiable トレイトを使用することで、それぞれ APIトークン、モデルファクトリ、通知機能を利用可能にしている。
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    //  ↓  マスアサインメント: $fillable プロパティは、モデルのインスタンスを作成する際に、どの属性を大量代入できるかを指定する。この例では、name, email, password の3つの属性が許可されている。
    protected $fillable = [
        'name',
        'email',
        'password',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // ↓  このコードは、Laravelのユーザーモデルにおいて、データの隠蔽と型変換に関する設定を行っている。

    // ↓  ※  $hidden プロパティ
    // 目的: モデルを配列や JSON に変換する際に、特定の属性を非表示にするための設定。
    // 内容: password と remember_token の2つの属性が指定されている。これにより、これらの属性はモデルを配列や JSON に変換する際に含まれない。セキュリティ上の理由から、パスワードやリメンバートークンは公開すべきではないため、この設定が重要といえる。
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    // ↓  ※  $casts プロパティ
    // 目的: モデルの属性のデータ型をキャストする為の設定。
    // 内容: email_verified_at 属性を datetime 型にキャストするように指定している。これにより、データベースから取得された email_verified_at の値が、Carbonオブジェクトに変換され、日付・時刻関連の操作が容易になる。

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
// ※  まとめ
// このコードは、ユーザーモデルのセキュリティとデータ処理の効率性を向上させるための設定を行っている。
// パスワードとリメンバートークンを非表示にし、メール認証の日付を適切なデータ型に変換することで、アプリケーションの信頼性を高めている。