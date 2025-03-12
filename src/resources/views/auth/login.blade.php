@extends('layouts.app')
{{-- layouts/app.blade.phpファイルのレイアウトを継承する --}}


{{-- ↓の@section('css') と @endsectionで 囲われた部分が、
layouts/app.blade.php の @yield('css')に 埋め込まれる --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css')}}">
{{-- ↑ cssファイルをリンクするためのHTMLタグ。
Laravelのassetヘルパー関数を使って、指定したcssファイルへのパスを生成。assetヘルパー関数は、URL生成に役立つ。 --}}
@endsection


{{-- ↓の@section('link') と @endsectionで囲われた部分が、
layouts/app.blade.phpの@yield('link')に埋め込まれる --}}
@section('link')

{{-- ↓ Webページのヘッダー部分に「登録」というリンクを作成するためのもの --}}
<a class="header__link" href="/register">register</a>
@endsection
{{-- ↑
・<a>タグ:
ハイパーリンクを作成するためのHTMLタグ。
・href="/register": リンク先のURLを指定している。
この場合、"/"はルートディレクトリを表し、
"register"は、登録ページへのパスを示す。
クリックすると、/register というURLのページに遷移する。

・class="header__link":
このリンク要素に "header__link" というクラス名を付け、CSSでスタイル付けをしている。
・@endsection:
このコードは、テンプレートエンジン（Bladeなど）のディレクティブで、あるセクションの終了を示す。この場合、@yield('link') で定義されたセクションの終わりを示していると考えられる。 --}}



{{-- ↓ Webページのコンテンツ部分にログインフォームを表示するためのテンプレートの一部。--}}

@section('content')
<div class="login-form">
  <h2 class="login-form__heading content__heading">Login</h2>
  <div class="login-form__inner">
    <form class="login-form__form" action="/login" method="post">
      @csrf

{{--↑
・@section('content'): contentという名前のセクションを定義する。このセクション内に記述された内容が、メインコンテンツエリアに埋め込まれる。
・<div class="login-form">: ログインフォーム全体を囲むコンテナ要素。
・<h2 class="login-form__heading content__heading">Login</h2>: ログインフォームのタイトルを表示。
・<div class="login-form__inner">: ログインフォームの内部要素をグループ化するコンテナ。
・<form class="login-form__form" action="/login" method="post">: ログインフォームの開始タグ。
・action="/login": フォームが送信されたときに処理されるURLを指定。
この場合、/login というパスに送信される。
・method="post": フォームデータの送信方法をPOSTメソッドに指定。
・@csrf: CSRF（Cross-Site Request Forgery）対策のためのトークンを生成するディレクティブ。--}}


{{-- ↓ ログインフォーム内のメールアドレス入力部分を作成。 --}}
      <div class="login-form__group">

        <label class="login-form__label" for="email">メールアドレス</label>
        {{-- ↑ メールアドレス入力欄のラベル。
        for="email" は、このラベルが id="email" の入力要素に対応していることを示す。 --}}
        <input class="login-form__input" type="mail" name="email" id="email" placeholder="例: test@example.com">
{{-- ↑
メールアドレスを入力するためのフォーム要素。
type="mail": 入力エリアをメールアドレス専用のデザインにする。(ブラウザ依存)
name="email": 送信されたフォームデータにおいて、この入力欄のデータを識別するための名前で、サーバー側はこの名前で値を受け取る。
id="email": この入力要素の一意な識別子。
placeholder=: 入力例。--}}

        <p class="register-form__error-message">
{{-- ↑ エラーメッセージを表示するための要素。 --}}

{{-- ↓ バリデーションエラーがあるかチェック。確認するフォーム要素の指定。
ここでは'email'。 --}}
          @error('email')
          {{ $message }}
          @enderror
        </p>
      </div>



{{-- ↓ パスワード入力に関する要素をグループ化する要素。 --}}
      <div class="login-form__group">

{{-- ↓ パスワード入力欄のラベル。
for="password" 属性によって、id="password" の入力要素と関連付けている。--}}
        <label class="login-form__label" for="password">パスワード</label>


{{-- ↓
パスワードを入力するためのフォーム要素。
・type="password": 入力された文字がアスタリスク（*）などの記号で隠されるようになり、パスワードの内容が直接表示されないようにする。
・name="password": フォーム送信時にサーバー側に送信されるデータの名前。
サーバー側でこの名前でパスワードの値を受け取る。
・id="password": この入力要素の一意な識別子。
・placeholder="例: coachtech1106": 入力例 --}}
        <input class="login-form__input" type="password" name="password" id="password" placeholder="例: coachtech1106">


        {{-- ↓ パスワード入力欄のエラー表示とログインボタンを定義。 --}}

        {{-- ↓ エラーメッセージを表示するための要素。 --}}
        <p>

        @error('password')
        {{ $message }}
        @enderror
{{-- ↑ passwordフィールドにバリデーションエラーがある場合に、その後のコードを実行。
・{{ $message }}: バリデーションエラーメッセージの内容を出力する。
$message変数には、エラーメッセージが格納されている。--}}
        </p>
    </div>


    <input class="login-form__btn btn" type="submit" value="ログイン">
    {{-- ↑
ログインボタンの要素。
・type="submit": ボタンがクリックされたときに、フォームが送信されることを示す。
・value="ログイン": ボタンに表示されるテキスト。--}}
    </form>
    </div>
</div>
@endsection('content')