<?php

// ↓  このコードは、Laravelのモデルクラス Contact を定義している。このモデルは、データベースの contacts テーブルに対応し、カテゴリーとの関係を定義している。

// ↓  名前空間: App\Models ディレクトリに属するクラスであることを示す。
namespace App\Models;

// ↓  クラスインポート: HasFactory と Model クラスをインポート。
use
    Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ↓  Contact というモデルクラスを定義。
class Contact extends Model
{
    // ↓  モデルファクトリを使用可能にします。
    use HasFactory;

    // ↓  id 以外のすべてのカラムに大量代入を許可します。
    protected $guarded = [
        'id',
    ];

    // ↓  カテゴリーとのリレーションシップを定義。

    // ↓  このメソッドは、Contact モデルと Category モデル間の関係を定義。
    // belongsTo メソッドは、1対多の関係を表す。つまり、1つの Contact は1つの Category に属している。
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
// ※ belongsTo メソッドは、モデル間の関係を定義する重要な要素。
// このモデルは、お問い合わせフォームのデータ保存や検索などの処理で使用される。