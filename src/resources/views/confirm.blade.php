@extends('layouts.app')
{{-- layouts/app.blade.phpファイルのレイアウトを継承する --}}


@section('css')
{{-- ↑ ここから@endsectionまでがcssという名前のセクションとして定義。 --}}
<link rel="stylesheet" href="{{ asset('css/confirm.css')}}">
{{-- ↑ cssファイルをリンクするためのHTMLタグ。
Laravelのassetヘルパー関数を使って、指定したcssファイルへのパスを生成。assetヘルパー関数は、URL生成に役立つ。 --}}
@endsection



{{-- ↓の@section('content') と @endsectionで囲われた部分が、
layouts/app.blade.phpの@yield('content')に埋め込まれる --}}
@section('content')



<div class="confirm-form">
  {{-- ↑ 確認フォーム全体を囲むコンテナ要素。 --}}
  <h2 class="confirm-form__heading content__heading">Confirm</h2>

  <div class="confirm-form__inner">
{{-- ↑ 確認フォームの内容を配置するためのコンテナ要素。 --}}

    <form action="/thanks" method="post">
{{-- ↑ フォーム送信先のURLを指定。この場合は/thanksというルートに送信。
method="post": POSTメソッドは、サーバーにデータを送信する際に一般的に使用される。

※ POST と GET の違い

GETメソッド
URLに直接データを含める: 送信するデータはURLの末尾に「?」をつけて、キーと値のペアで記述。
データの取得: サーバーからデータを取得する際に主に使用される。
安全性: データがURLに含まれるため、セキュリティ上のリスクが比較的高く、機密性の高いデータを送信する場合には不向き。
キャッシュ: ブラウザやプロキシサーバーでキャッシュされる可能性がある。
ブックマーク: ブラウザのブックマークに登録できる。

POSTメソッド
リクエストボディにデータを含める: 送信するデータは、HTTPリクエストのボディ部分に含まれる。
データの送信: サーバーにデータを登録したり、更新したりする場合に主に使用される。
安全性: GETに比べて安全性が高く、パスワードなどの機密性の高いデータを送信する場合に適している。
キャッシュ: 一般的にキャッシュされない。
ブックマーク: ブラウザのブックマークに登録しても、データは送信されない。

● どちらを使うべきか
データの公開性: URLにデータを表示させたくない場合はPOST、問題ない場合はGET

データのサイズ: 大量のデータを扱う場合はPOST

安全性: 機密性の高いデータを送信する場合はPOST

冪等性: 同じリクエストを複数回実行しても結果が変わらないことを冪等性と言うが、GETは冪等であることが求められるケースが多い。

● まとめ
GET: データの取得、簡単な検索など
POST: データの登録、更新、削除など、副作用のある処理

一般的に、データの変更を伴う処理にはPOST、データの取得にはGETが使用される  --}}

      @csrf
{{-- ↑ 保護のためのトークンを生成する Blade ディレクティブ --}}


      <table class="confirm-form__table">
        {{-- ↑ 表（テーブル）を作成するための要素。
        このテーブルに、confirm-form__tableというクラス名を付けている。このクラス名で、cssでスタイル付けをする。
● 表の構造
<table>: 表全体を囲む。
<tr>: 表の行を表す。
<th>: 表のヘッダーセルを表す。
  通常、表の最初の行に配置され、列の見出しとして使用される。
<td>: 表のデータセルを表す。--}}

        <tr class="confirm-form__row">
          {{-- ↑ テーブルの行を表す要素。 --}}
          <th class="confirm-form__label">お名前</th>
          {{-- ↑ テーブルのヘッダーセルで、「お名前」というラベルを表示。 --}}
          <td class="confirm-form__data">{{ $contacts['first_name'] }}&nbsp;{{ $contacts['last_name'] }}</td>
          {{-- ↑ テーブルのデータセルで、ユーザーが入力した名前を表示。
          {{ $contacts['first_name'] }} と {{ $contacts['last_name'] }} で、姓と名をそれぞれ表示。 --}}
          <input type="hidden" name="first_name" value="{{ $contacts['first_name'] }}">
          <input type="hidden" name="last_name" value="{{ $contacts['last_name'] }}">
{{-- ↑ ユーザーが入力した性・名を隠しフィールドとして送信。

・type="hidden": この属性を指定して、要素が隠しフィールドになることを示す。
・name="hidden_field": サーバー側でこのフィールドを参照するための名前を指定。
・value="some_value": 送信する値を指定。


※ 隠しフィールドとは・・・
隠しフィールドは、ユーザーには表示されないが、フォームの処理において重要。

・データの保持:
ユーザーが直接入力したり選択したりすることなく、
あらかじめ決められた値をサーバーに送信することができる。
例えば、フォームの識別番号や、前の画面で選択された値などを保持し、次の処理に渡すことができる。

・CSRF対策:
CSRF（Cross-Site Request Forgery）攻撃を防ぐためのトークンを格納するのに使用される。
・ログ記録:
どのユーザーがどのフォームを送信したかなどの情報を記録するために、ユーザーIDなどを隠しフィールドに格納することができる。  --}}
        </tr>


        <tr class="confirm-form__row">
                    {{-- ↑ テーブルの行を表す要素。 --}}
          <th class="confirm-form__label">性別</th>
      {{-- ↑ テーブルのヘッダーセルで、「性別」というラベルを表示。 --}}

          <td class="confirm-form__data">
            @if($contacts['gender'] == 1)
            男性
            @elseif($contacts['gender'] == 2)
            女性
            @else
            その他
            @endif
          </td>
          <input type="hidden" name="gender" value="{{ $contacts['gender'] }}">
{{-- ↑ 
・input type="hidden": 隠しフィールドで、ユーザーには表示されない。
name="gender": フォーム送信時にサーバーに送信される際のフィールド名。
value="{{ $contacts['gender'] }}": 実際の性別を表す値を格納。 --}}

        </tr>

        <tr class="confirm-form__row">
{{-- ↑ テーブルの行を表す要素。cssのスタイル付けに使用。 --}}
          <th class="confirm-form__label">メールアドレス</th>
 {{-- ↑ テーブルのヘッダーセルで、「メールアドレス」というラベルを表示。 --}}

          <td class="confirm-form__data">{{ $contacts['email'] }}</td>
{{-- ↑ 
{{ $contacts['email'] }}: ユーザーが入力したメールアドレスを表示。
 $contacts['email'] には、ユーザーがフォームに入力したメールアドレスが格納されていると考えられる。 --}}

          <input type="hidden" name="email" value="{{ $contacts['email'] }}">
          {{-- ↑
・input type="hidden": 隠しフィールドで、ユーザーには表示されない。
・name="email": フォーム送信時にサーバーに送信される際のフィールド名。
・value="{{ $contacts['email'] }}": 実際のメールアドレスを格納。 --}}
        </tr>


        <tr class="confirm-form__row">
          {{-- ↑ テーブルの行を表す要素。cssのスタイル付けに使用。 --}}
          <th class="confirm-form__label">電話番号</th>
 {{-- ↑ テーブルのヘッダーセルで、「電話番号」というラベルを表示。 --}}

          <td class="confirm-form__data">{{ $contacts['tel_1'] }}{{ $contacts['tel_2'] }}{{ $contacts['tel_3'] }}</td>
{{-- ↑
td class="confirm-form__data"：テーブルのデータセルを表し、電話番号を表示。
{{ $contacts['tel_1'] }}{{ $contacts['tel_2'] }}{{ $contacts['tel_3'] }}：ユーザーが入力した電話番号の３つの部分を連結して表示。 --}}

          <input type="hidden" name="tel_1" value="{{ $contacts['tel_1'] }}">
          <input type="hidden" name="tel_2" value="{{ $contacts['tel_2'] }}">
          <input type="hidden" name="tel_3" value="{{ $contacts['tel_3'] }}">
{{-- ↑ 電話番号の各部分を隠しフィールドとして送信するための要素。 --}}

        </tr>

        <tr class="confirm-form__row">
          {{-- ↑ テーブルの行を表す要素。cssのスタイル付けに使用。 --}}
          <th class="confirm-form__label">住所</th>
{{-- ↑ テーブルのヘッダーセルで、「住所」というラベルを表示。 --}}

          <td class="confirm-form__data">{{ $contacts['address'] }}</td>
          <input type="hidden" name="address" value="{{ $contacts['address'] }}">
{{-- ↑
・td class="confirm-form__data"：テーブルのデータセルを表し、住所を表示。
・{{ $contacts['address'] }}：ユーザーが入力した住所を表示。

・input type="hidden" name="address" value="{{ $contacts['address'] }}"：
住所を隠しフィールドとして送信するための要素。
・input type="hidden": 隠しフィールドで、ユーザーには表示されない。
・name="address": フォーム送信時にサーバーに送信される際のフィールド名。
・value="{{ $contacts['address'] }}": 実際の住所を格納。 --}}

        </tr>
      
        <tr class="confirm-form__row">
          {{-- ↑ テーブルの行を表す要素。cssのスタイル付けに使用。 --}}
          <th class="confirm-form__label">建物名</th>
{{-- ↑ テーブルのヘッダーセルで、「建物名」というラベルを表示。 --}}
          <td class="confirm-form__data">{{ $contacts['building'] }}</td>
          <input type="hidden" name="building" value="{{ $contacts['building'] }}">
{{-- ↑
・td class="confirm-form__data"：テーブルのデータセルを表し、建物名を表示。
・{{ $contacts['building'] }}：ユーザーが入力した建物名を表示。
・input type="hidden" name="building" value="{{ $contacts['building'] }}"：建物名を隠しフィールドとして送信するための要素。
・input type="hidden": 隠しフィールドで、ユーザーには表示されない。
・name="building": フォーム送信時にサーバーに送信される際のフィールド名。
・value="{{ $contacts['building'] }}": 実際の建物名を格納。 --}}

        </tr>

        
        <tr class="confirm-form__row">
          {{-- ↑ テーブルの行を表す要素。cssのスタイル付けに使用。 --}}
          <th class="confirm-form__label">お問い合わせの種類</th>
{{-- ↑ テーブルのヘッダーセルで、「お問い合わせの種類」というラベルを表示。 --}}
          <td class="confirm-form__data">{{ $category->content }}</td>
{{--
{{ $category->content }}: ユーザーが選択したお問い合わせの種類を表示。$category->content には、お問い合わせの種類の名前が格納されていると考えられる。 --}}

          <input type="hidden" name="category_id" value="{{ $contacts['category_id'] }}">
{{--
input type="hidden": 隠しフィールドで、ユーザーには表示されない。
name="category_id": フォーム送信時にサーバーに送信される際のフィールド名。
value="{{ $contacts['category_id'] }}": お問い合わせの種類のIDを格納。$contacts['category_id'] には、お問い合わせの種類のIDが格納されていると考えられる。 --}}
        </tr>


        <tr class="confirm-form__row">
          {{-- ↑ テーブルの行を表す要素。cssのスタイル付けに使用。 --}}
          <th class="confirm-form__label">お問い合わせ内容</th>
{{-- ↑ テーブルのヘッダーセルで、「お問い合わせの内容」というラベルを表示。 --}}
          <td class="confirm-form__data">{{ $contacts['detail'] }}</td>
{{--
{{ $contacts['detail] }}: ユーザーが入力したお問い合わせ内容を表示。
   $contacts['detail'] }}: には、ユーザーがフォームに入力した
   お問い合わせ内容が格納されていると考えられる。 --}}
          <input type="hidden" name="detail" value="{{ $contacts['detail'] }}">
{{--
input type="hidden": 隠しフィールドで、ユーザーには表示されない。
name="detail": フォーム送信時にサーバーに送信される際のフィールド名。
value="{{ $contacts['detail'] }}": 実際のお問い合わせ内容を格納。 --}}
        </tr>
      </table>

      <div class="confirm-form__btn-inner">
{{-- ↑ ブロックレベルの要素で、ボタンをまとめるコンテナ要素。
このクラス名でcssのスタイル付けをする。 --}}
        <input class="confirm-form__send-btn btn" type="submit" value="送信" name="send">
{{--
input type="submit": このボタンがクリックされたときに、フォームが送信されることを示す。
value="送信": ボタンに表示される文字列。
name="send": このボタンが押されたときにサーバー側で識別するための名前。 --}}
        <input class="confirm-form__back-btn" type="submit" value="修正" name="back">
{{--
input type="submit": このボタンがクリックされたときに、フォームが送信されることを示す。
value="修正": ボタンに表示される文字列。
name="back": このボタンが押されたときにサーバー側で識別するための名前。 --}}
      </div>
    </form>
  </div>
</div>
@endsection