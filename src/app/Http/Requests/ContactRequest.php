<?php

// ↓  このコードは、Laravelのフォームリクエストクラス ContactRequest を定義している。このクラスは、入力データの検証を行うために使用される。

// ↓  名前空間の宣言: App\Http\Requests ディレクトリに属するクラスであることを宣言している。
namespace App\Http\Requests;

//  ↓  クラスをインポートする。これは、フォームリクエストの基底クラス。
use Illuminate\Foundation\Http\FormRequest;

// ↓  フォームリクエストクラスの定義: ContactRequest という名前のフォームリクエストクラスを定義し、FormRequest クラスを継承する。
class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

        // ↑    authorize メソッド: ユーザーがリクエストを実行できるかどうかを判断するメソッド。この例では、常に true を返しているため、すべてのユーザーがリクエストを実行できることになる。
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    //  ↓  このコードは、Laravelの ContactRequest クラス内の rules メソッドで、フォーム入力のバリデーションルールを定義している。

    // ↓  メソッドの宣言: rules メソッドは、配列を返すことを宣言している。
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required | email',
            'tel_1' => 'required | max:5 | regex:/^[0-9]+$/',
            'tel_2' => 'required | max:5 | regex:/^[0-9]+$/',
            'tel_3' => 'required | max:5 | regex:/^[0-9]+$/',
            'address' => 'required',
            'category_id' => 'required',
            'detail' => 'required | max:120',
        ];
        // ※  バリデーションルール:
        // first_name, last_name, gender, email, tel_1, tel_2, tel_3, address, category_id, detail というフィールドに対して、バリデーションルールを定義している。

        // required: フィールドは必須であることを指定。
        // email: メールアドレス形式であることを指定。
        // max:5: フィールドの最大文字数を5文字に指定。
        // regex:/^[0-9]+$/: フィールドの内容が数字のみであることを指定。
    }

    // ↓  このコードは、Laravelのフォームリクエストで、バリデーションエラーが発生した場合に表示されるカスタムエラーメッセージを定義している。

    // ↓  messages メソッド: このメソッドは、バリデーションエラーが発生した際に、どのフィールドでどのようなエラーが発生したかを示すカスタムメッセージを返すため使用される。

    //  ↓  配列: 返される値は配列形式で、
    // キーがバリデーションルールとフィールド名の組合わせ、
    // 値がカスタムエラーメッセージとなっている。
    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel_1.required' => '電話番号を入力してください',
            'tel_1.regex' => '電話番号は半角数字で入力してください',
            'tel_1.max' => '電話番号は5桁までの数字で入力してください',
            'tel_2.required' => '電話番号を入力してください',
            'tel_2.regex' => '電話番号は半角数字で入力してください',
            'tel_2.max' => '電話番号は5桁までの数字で入力してください',
            'tel_3.required' => '電話番号を入力してください',
            'tel_3.regex' => '電話番号は半角数字で入力してください',
            'tel_3.max' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせの内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
