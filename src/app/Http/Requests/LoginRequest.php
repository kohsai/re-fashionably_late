<?php

// ↓  このコードは、Laravelのログイン機能において、
// ユーザー認証を行うためのフォームリクエストクラス LoginRequest を定義している。

// ↓  名前空間: App\Http\Requests ディレクトリに属するクラスであることを宣言している。
namespace App\Http\Requests;

// ↓  クラスのインポート: Laravel\Fortify\Http\Requests\LoginRequest を FortifyLoginRequest という別名でインポートしている。
// これは、Laravel Fortify パッケージが提供するログインリクエストの基底クラス。
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

// ↓  ログインリクエストクラスの定義: LoginRequest という名前のフォームリクエストクラスを定義し、FortifyLoginRequest を継承。
class LoginRequest extends FortifyLoginRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // ↑  authorize メソッド: ユーザーがリクエストを実行できるかどうかを判断するメソッド。この例では、常に true を返しているため、すべてのユーザーがログインリクエストを実行できる。

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // ↓  rules メソッド: このメソッドは、フォームの各フィールドに対して、どのようなバリデーションルールを適用するかを定義している。
    public function rules()
    {
        return [
            'email' => 'required | email',
            'password' => 'required'
        ];
        // ※  ↑
        // email フィールド:
        // required: このフィールドに入力することが必須であることを示す。
        // email: 入力された値がメールアドレスの形式であることを検証する。

        // password フィールド:
        // required: このフィールドに入力することが必須であることを示す。

    }
}
