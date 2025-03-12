@extends('layouts.app')
{{-- layouts/app.blade.phpファイルのレイアウトを継承する --}}


{{-- ↓の@section('css') と @endsectionで 囲われた部分が、
layouts/app.blade.php の @yield('css')に 埋め込まれる --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
{{-- ↑ cssファイルをリンクするためのHTMLタグ。
Laravelのassetヘルパー関数を使って、指定したcssファイルへのパスを生成。assetヘルパー関数は、URL生成に役立つ。 --}}
@endsection


{{-- ↓の@section('link') と @endsectionで囲われた部分が、
layouts/app.blade.phpの@yield('link')に埋め込まれる --}}
@section('link')


{{-- ↓ Webページのヘッダー部分に「ログイン」というリンクを作成するためのもの --}}
<a class="header__link" href="/login">login</a>
@endsection
{{-- ↑
・<a>タグ:
ハイパーリンクを作成するためのHTMLタグ。
・href="/login": リンク先のURLを指定している。
この場合、"/"はルートディレクトリを表し、
"login"は、登録ページへのパスを示す。
クリックすると、/login というURLのページに遷移する。

・class="header__link":
このリンク要素に "header__link" というクラス名を付け、CSSでスタイル付けをしている。
・@endsection:
このコードは、テンプレートエンジン（Bladeなど）のディレクティブで、あるセクションの終了を示す。この場合、@yield('link') で定義されたセクションの終わりを示していると考えられる。 --}}



@section('content')
<div class="register-form">
    <h2 class="register-form__heading content__heading">Register</h2>
    <div class="register-form__inner">

    <form class="register-form__form" action="/register" method="post">
    @csrf

{{-- ↑
・@section('content'): contentという名前のセクションを定義する。このセクション内に記述された内容が、メインコンテンツエリアに埋め込まれる。

・<div class="register-form">: 登録フォーム全体のコンテナとなる要素。
・<h2 class="register-form__heading content__heading">Register</h2>: 登録フォームのタイトルを表示。
・<div class="register-form__inner">: フォーム要素を配置するためのコンテナ。
・<form class="register-form__form" action="/register" method="post">: フォーム要素。
・action="/register": フォームが送信されたときにデータが送信されるURLを指定。
・method="post": フォームデータの送信方法をPOSTメソッドに指定。
・@csrf: LaravelのBladeディレクティブで、CSRFトークンを生成し、フォーム内に隠しフィールドとして追加する。CSRF攻撃を防ぐために必要 --}}

{{-- ↓ 名前入力に関する要素をグループ化するコンテナ要素。 --}}
<div class="register-form__group">
    <label class="register-form__label" for="name">お名前</label>
{{-- ↑ 名前入力欄のラベル。for="name" 属性によって、id="name" の入力要素と関連付けられている。 --}}

    <input class="register-form__input" type="text" name="name" id="name" placeholder="例：山田 太郎">
{{-- ↑ 氏名を入力するためのフォーム要素。
type="text": 文字列を入力するための入力タイプ。
name="name": フォーム送信時にサーバー側に送信されるデータの名前。サーバー側でこの名前で氏名の値を受け取る。
id="name": この入力要素の一意な識別子。
placeholder=: 入力例。--}}
    <p class="register-form__error-message">
{{-- ↑ エラーメッセージを表示するための要素。 --}}

{{-- ↓ バリデーションエラーがあるかチェック。確認するフォーム要素の指定。
ここでは'name'。 --}}

        @error('name')
        {{ $message }}
        @enderror
    </p>
</div>


{{-- ↓ メールアドレス入力に関する要素をグループ化する要素。 --}}
    <div class="register-form__group">

{{-- ↓
メールアドレス入力欄のラベル。for="email" 属性によって、id="email" の入力要素と関連付けられている。 --}}
        <label class="register-form__label" for="email">メールアドレス</label>

{{-- ↓
・入力要素を表すHTMLタグ。
・class="register-form__input": この入力要素にregister-form__inputというクラス名を付け、CSSでスタイル付けをしている。
・type="email": この入力要素がメールアドレスの入力用であることをブラウザに伝える。
ブラウザによっては、@マークの自動挿入や入力形式のチェックが行われることがある。
・name="email": フォーム送信時にサーバー側に送信されるデータの名前。サーバー側でこの名前でメールアドレスの値を受け取る。
・id="email": この入力要素の一意な識別子。
・placeholder=: 入力例。--}}
    <input class="register-form__input" type="mail" name="email" id="email" placeholder="例：test@example.com">


{{-- ↓ この<p>要素にregister-form__error-messageというクラス名を付け、CSSでスタイル付けをしている。 --}}
        <p class="register-form__error-message">


        @error('email')
        {{ $message }}
        @enderror
{{-- ↑
@error('email'):
emailフィールドにバリデーションエラーが発生しているかどうかをチェック。
エラーが発生している場合、このディレクティブ内のコードが実行される。

・{{ $message }}:
バリデーションエラーメッセージを画面に表示。
$message変数には、エラーメッセージが格納されている。 --}}
        </p>
    </div>

{{-- ↓ ユーザーがパスワードを入力するためのフォーム要素を定義。
入力に関する要素をグループ化するコンテナ。 --}}
    <div class="register-form__group">


{{-- ↓ パスワード入力欄のラベル。for="password" 属性によって、id="password" の入力要素と関連付けている。 --}}
        <label class="register-form__label" for="password">パスワード</label>


{{-- ↓
・input class="register-form__input": この入力要素にregister-form__inputというクラス名を付け、CSSのスタイル付けをしている。
・type="password": この入力要素がパスワードの入力用であることをブラウザに伝えている。ブラウザによっては、入力された文字が* (アスタリスク)などの記号で表示され、平文で表示されるのを防ぐ。
・name="password": フォーム送信時にサーバー側に送信されるデータの名前。サーバー側でこの名前でパスワードの値を受け取る。
・id="password": この入力要素の一意な識別子。
・placeholder="例：coachtech1106": 入力例。--}}
        <input class="register-form__input" type="password" name="password" id="password" placeholder="例：coachtech1106">

{{-- ↓ ユーザーがパスワードを入力する際に、バリデーションエラーが発生した場合に、そのエラーメッセージを画面上に表示する要素。 --}}

{{-- ↓ エラーメッセージを表示するための領域を定義。 --}}

{{-- ↓
この<p>要素に register-form__error-messageというクラス名を付け、CSSのスタイル付けをする。 --}}
<p class="register-form__error-message">


        @error('password')
        {{ $message }}
        @enderror
{{-- ↑ passwordフィールドにバリデーションエラーがある場合に、その後のコードを実行。
・{{ $message }}: バリデーションエラーメッセージの内容を出力する。
$message変数には、エラーメッセージが格納されている。--}}
        </p>
    </div>


{{-- ↓ ユーザーが登録フォームに入力した内容を送信するためのボタンを定義。 --}}
    <input class="register-form__btn btn" type="submit" value="登録">
{{-- ↑
・input class=
"register-form__btn btn":
この入力要素に「register-form__btn」と「btn」という2つのクラス名を付け、CSSのスタイル付けを行う。
・type="submit": この入力要素が送信ボタンであることをブラウザに伝える。このボタンがクリックされると、フォームに入力されたデータがサーバーに送信される。
・value="登録": ボタンに表示されるテキスト。この場合、「登録」という文字がボタン上に表示される。 --}}

    </form>
    </div>
</div>
@endsection('content')