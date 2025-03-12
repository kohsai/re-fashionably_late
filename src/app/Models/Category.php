<?php

// ↓  このコードは、Laravelのモデルクラスである Category を定義している。
// ↓  名前空間の宣言: App\Models という名前空間にこのクラスが属することを宣言している。
namespace App\Models;


use
    // ↓  モデルファクトリを使用するためのトレイト。
    Illuminate\Database\Eloquent\Factories\HasFactory;

// ↓  Laravelのモデルの基底クラス
use Illuminate\Database\Eloquent\Model;


// ↓  Category という名前のモデルクラスを定義し、Model クラスを継承している。
class Category extends Model
{
    // ↓  モデルファクトリを使用できるようにする。
    use HasFactory;

    // ↓  id カラムを除くすべてのカラムに対して、大量代入が可能であることを指定。
    protected $guarded = [
        'id',
    ];
}
