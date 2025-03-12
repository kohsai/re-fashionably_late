@extends('layouts/app')
{{-- layouts/app.blade.phpファイルのレイアウトを継承する --}}


{{-- ↓の@section('css') と @endsectionで 囲われた部分が、
layouts/app.blade.php の @yield('css')に 埋め込まれる --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css')}}">
@endsection


{{-- ↓の@section('link') と @endsectionで囲われた部分が、
layouts/app.blade.phpの@yield('link')に埋め込まれる --}}
@section('link')

{{-- ↓ ログアウト処理を行うためのフォームを定義。
ユーザーがフォーム内のボタンをクリックすると、サーバーにログアウト要求が送信され、ユーザーはシステムからログアウトされる。 --}}
<form action="/logout" method="post">
{{-- ↑ form要素。この中にフォームの入力項目や送信ボタンなどを配置。
form action="/logout":フォームを送信した際に、/logoutというURLにデータが送信される。
このURLで定義された処理が、ログアウト処理を実行する。

method="post":フォームの送信方法をPOSTメソッドに設定。
POSTメソッドは、送信データがサーバー側に隠ぺいされるのでより安全とされる。 --}}
  @csrf
  {{-- ↑ 保護のためのトークンを生成する Blade ディレクティブ --}}
  <input class="header__link" type="submit" value="logout">
  {{--
  ・input type="submit": この入力要素をボタンとして機能させる。
・value="logout": ボタンに表示される文字列を「logout」に設定。
・class="header__link":
この要素に「header__link」というクラス名を付けて、CSSでスタイルを定義するために使用。 --}}
</form>

{{-- 流れとして、

・ユーザーが「logout」ボタンをクリック。
・フォームが送信され、/logout というURLに、CSRFトークンを含むデータがPOSTメソッドで送信される。
・サーバー側の処理で、送信されたCSRFトークンが検証され、不正なリクエストでないことが確認される。
・認証情報がクリアされ、ユーザーはログアウト状態になる。
通常は、ログインページやトップページにリダイレクトされる。 --}}
@endsection


{{-- ↓の@section('content') と @endsectionで囲われた部分が、
layouts/app.blade.phpの@yield('content')に埋め込まれる --}}
@section('content')



{{-- ↓  流れとして、

・ユーザーが検索フォームに入力し、送信ボタンをクリックする。
・フォームが送信され、/search というURLに、入力された検索キーワードとCSRFトークンがGETメソッドで送信される。
・サーバー側の処理で、送信されたCSRFトークンが検証され、不正なリクエストでないことが確認される。
・入力された検索キーワードをもとに、データベースなどから該当するデータが検索される。
・検索結果が表示されるページにリダイレクトされる。 --}}



<div class="admin">
  {{-- ↑ この要素は、管理者ページ全体の領域を囲んでいる。
  このクラス名でcssのスタイル付けをする。 --}}
  <h2 class="admin__heading content__heading">Admin</h2>
  {{-- ↑ このh2要素に「admin__heading」と「content__heading」というクラス名を付けていて、cssのスタイル付けをする。 --}}
  <div class="admin__inner">
    {{-- ↑ この要素は、管理者ページ内のコンテンツ領域を囲んでいる。
    クラス名でCSSのスタイル付けを行う。 --}}
    <form class="search-form" action="/search" method="get">
      @csrf
{{--
・form class="search-form": このform要素に「search-form」というクラス名を付けている。
・action="/search": フォームを送信した際に、/search というURLにデータが送信される。このURLで定義された処理が、検索処理を実行する。
・method="get": フォームの送信方法をGETメソッドに設定。
GETメソッドは、送信データがURLに含まれて送信される方法。

@csrf:
LaravelのBladeテンプレートエンジンで提供されるディレクティブ。
CSRF (Cross-Site Request Forgery) 攻撃を防ぐためのトークンを自動的にフォームに挿入し、このトークンは、不正なリクエストを検出するために使用される。--}}


      <input class="search-form__keyword-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{request('keyword')}}">

{{-- ↑
流れとして、

・ユーザーがこの入力欄に検索キーワードを入力する。
・ユーザーがフォームを送信すると、入力されたキーワードが
  name="keyword" で指定された名前でサーバー側に送信される。
・サーバー側では、受け取った keyword の値を使って、
  データベースなどのデータを検索する。
・検索結果が表示される。


・input class="search-form__keyword-input":
この入力要素に「search-form__keyword-input」というクラス名を付けていて、
このクラス名は、CSSでこの要素のスタイルを定義するために使用される。

・type="text": この入力要素がテキスト入力欄であることを示す。
・name="keyword": この入力要素の名前を「keyword」に設定している。
フォーム送信時に、この名前でサーバー側にデータが送信される。
・placeholder=入力例。
・value="{{request('keyword')}}": この入力欄の初期値を設定。
・{{request('keyword')}} は、LaravelのBladeテンプレートエンジンで、
リクエストパラメータの keyword の値を取得するコード。
前回の検索で入力されたキーワードが、再び入力欄に表示されるように設定されている。 --}}


{{-- ↓ 検索フォーム内に性別選択のためのドロップダウンリストを作成。 --}}

      <div class="search-form__gender">
        {{-- ↑ 性別選択のためのコンテナ要素。 --}}

        <select class="search-form__gender-select" name="gender" value="{{request('gender')}}">
{{-- ↑
・「search-form__gender-select」というクラス名を付けていて、cssのスタイル付けを行う。
・name="gender": このselect要素の名前を「gender」に設定。フォーム送信時に、選択された値が「gender」という名前でサーバー側に送信される。
・value="{{request('gender')}}": この属性で、前回の検索で選択された性別を保持する。
{{request('gender')}} は、LaravelのBladeテンプレートエンジンで、リクエストパラメータの gender の値を取得するコード。--}}

          <option disabled selected>性別</option>
{{-- ↑
このoption要素は、ドロップダウンリストの最初の選択肢を表す。
disabled属性: この選択肢を選択できないようにする。
selected属性: この選択肢がデフォルトで選択されている状態にする --}}
          <option value="1" @if( request('gender')==1 ) selected @endif>男性</option>
          <option value="2" @if( request('gender')==2 ) selected @endif>女性</option>
          <option value="3" @if( request('gender')==3 ) selected @endif>その他</option>

{{--↑
value="1": この選択肢の値を「1」に設定。
@if( request('gender')==1 ) selected @endif: 前回の検索で選択された性別が「1」（男性）の場合に、この選択肢を自動的に選択するようにする。

value="2": この選択肢の値を「2」に設定。
@if( request('gender')==2 ) selected @endif: 前回の検索で選択された性別が「2」（女性）の場合に、この選択肢を自動的に選択するようにする。

value="3": この選択肢の値を「3」に設定。
@if( request('gender')==3 ) selected @endif: 前回の検索で選択された性別が「3」（その他）の場合に、この選択肢を自動的に選択するようにする。 --}}
        </select>
      </div>

{{-- ↓ 検索フォーム内にお問い合わせの種類を選択するためのドロップダウンリストを作成 --}}
      <div class="search-form__category">
        {{-- ↑ お問い合わせの種類選択のためのコンテナ要素。
        このdiv要素に「search-form__category」というクラス名を付け、CSSでスタイル付けしている。--}}
        <select class="search-form__category-select" name="category_id">
{{-- ↑
このselect要素に「search-form__category-select」というクラス名を付けている。このクラス名は、CSSでスタイル付けしている。
name="category_id": このselect要素の名前を「category_id」に設定。
フォーム送信時に、選択された選択肢の値が「category_id」という名前でサーバー側に送信される。 --}}

          <option disabled selected>お問い合わせの種類</option>
{{-- このoption要素は、ドロップダウンリストの最初の選択肢を表す。
disabled属性: この選択肢を選択できないようにする。
selected属性: この選択肢がデフォルトで選択されている状態にする --}}

          @foreach($categories as $category)
          {{-- ↑ LaravelのBladeテンプレートエンジンで、$categories という変数に格納されたカテゴリデータの配列をループ処理する。 --}}
          
          <option value="{{ $category->id }}" @if( request('category_id')==$category->id ) selected @endif
            >{{$category->content }}
{{-- ↑
このoption要素は、各カテゴリの選択肢を表す。
・value="{{ $category->id }}": この選択肢の値をカテゴリのIDに設定する。
・@if( request('category_id')==$category->id ) selected @endif:
  この条件式は、前回の検索で選択されたカテゴリのIDと現在のカテゴリのIDが一致する場合に、この選択肢を自動的に選択するようにする。
`{{$category->content }}``: この部分で、カテゴリの名前や内容を表示する。 

流れとして、
・サーバー側で、カテゴリデータが $categories 変数に取得される。
・このコードが実行されると、$categories の各要素に対して、
<option> タグが生成され、ドロップダウンリストに表示される。
・ユーザーは、ドロップダウンリストからお問い合わせの種類を選択する。
・フォームが送信されると、選択されたカテゴリのIDが「category_id」という名前でサーバー側に送信される。
・サーバー側では、受け取った category_id の値を使って、検索条件を組み立てる--}}
          </option>
          @endforeach
        </select>
      </div>

{{-- ↓ 検索フォーム内に日付を入力するための欄を作成する。ユーザーはこの入力欄に日付を入力し、フォーム送信時にサーバー側に送信される。 --}}
      <input class="search-form__date" type="date" name="date" value="{{request('date')}}">
{{-- ↑
・input class="search-form__date": この入力要素に「search-form__date」というクラス名を付け、CSSでスタイル付けしている。
・type="date": この入力要素が日付を入力するための欄であることを示す。多くのブラウザでは、カレンダー形式で日付を選択できるインターフェースが提供される。
・name="date": この入力要素の名前を「date」に設定している。フォーム送信時に、入力された日付が「date」という名前でサーバー側に送信される。
・value="{{request('date')}}": この入力欄の初期値を設定している。
・{{request('date')}} は、LaravelのBladeテンプレートエンジンで、リクエストパラメータの date の値を取得するコード。前回の検索で入力された日付が、再び入力欄に表示されるように設定されている。--}}

{{-- ↓ 検索フォームの送信ボタンとリセットボタンを定義している。 --}}

      <div class="search-form__actions">
{{-- ↑ 送信ボタンとリセットボタンをまとめるためのコンテナ要素。
このdiv要素に「search-form__actions」というクラス名を付けて、CSSでスタイル付けをしている。--}}
        <input class="search-form__search-btn btn" type="submit" value="検索">
{{-- ↑
・input class="search-form__search-btn btn":
この入力要素に「search-form__search-btn」と「btn」というクラス名を付けている。CSSでスタイル付けをしている。
・type="submit": この入力要素が送信ボタンであることを示す。このボタンをクリックすると、フォームのデータがサーバーに送信される。
・value="検索": ボタンに表示される文字列を「検索」に設定している。 --}}

        <input class="search-form__reset-btn btn" type="submit" value="リセット" name="reset">
{{-- ↑
・input class="search-form__reset-btn btn":
この入力要素に「search-form__reset-btn」と「btn」というクラス名を付けている。CSSでスタイル付けをしている。
・type="submit": この属性によって、入力要素が送信ボタンとして機能する。
このボタンをクリックすると、フォームのデータがサーバーに送信される。
・value="リセット": ボタンに表示される文字列を「リセット」に設定している。
・name="reset": この入力要素の名前を「reset」に設定している。サーバー側でこのボタンが押されたことを判断するために使用される。 --}}
      </div>
    </form>

{{-- ↓ 検索結果のデータをエクスポートする機能を実装するためのフォームを定義。検索結果の一覧の下に「エクスポート」ボタンを設置し、ボタンをクリックすると現在の検索条件に基づいたデータをダウンロードできるような仕組みになっている。 --}}
    <div class="export-form">
{{-- ↑ エクスポートフォームを囲むコンテナ要素。
このdiv要素に「export-form」というクラス名を付け、CSSでスタイル付けをしている。--}}
      <form action="{{'/export?'.http_build_query(request()->query())}}" method="post">
        @csrf
{{-- ↑
form action: フォーム送信先のURLを指定。
{{'/export?'.http_build_query(request()->query())}} という部分は、現在の検索条件の情報をURLに付加して、エクスポート処理を行うコントローラーのURLを生成している。
・method="post": フォームの送信方法をPOSTメソッドに設定している。POSTメソッドは、送信データをHTTPリクエストのボディに含めて送信する方法。
・@csrf: LaravelのBladeテンプレートエンジンで提供されるディレクティブ。
CSRF (Cross-Site Request Forgery) 攻撃を防ぐためのトークンを自動的にフォームに挿入する --}}

    <input class="export__btn btn" type="submit" value="エクスポート">
{{-- ↑
・input class="export__btn btn": この入力要素に「export__btn」と「btn」というクラス名を付けている。CSSでスタイル付けをしている。
・type="submit": この入力要素が送信ボタンであることを示す。
このボタンをクリックすると、フォームのデータがサーバーに送信される。
・value="エクスポート": ボタンに表示される文字列を「エクスポート」に設定している。 --}}
      </form>

{{-- ↓ ページネーション(ページ分け)用のリンクを表示するためのコード。 --}}
      {{ $contacts->appends(request()->query())->links('vendor.pagination.custom') }}
{{-- ↑
・$contacts: 検索結果のデータが入っている変数。
・appends(request()->query()): ページネーションのリンクに、現在の検索条件の情報が保持・付加される。どのページからでもエクスポートすることができる。
・links('vendor.pagination.custom'): カスタムのページネーションビューを指定している。 --}}
    </div>


{{-- ↓ 管理画面で使用する表の見出し行を定義。
  この表は、複数の項目を列挙する際に使用。 --}}
    <table class="admin__table">
{{-- ↑  table:htmlの表を表す要素。
このテーブルに「admin__table」というクラス名を付け、CSSでスタイル付けをしている。 --}}
      <tr class="admin__row">
{{-- ↑ tr: テーブルの行を表す要素。
class="admin__row": この行に「admin__row」というクラス名を付け、CSSでスタイル付けをしている。 --}}


        <th class="admin__label">お名前</th>
        <th class="admin__label">性別</th>
        <th class="admin__label">メールアドレス</th>
        <th class="admin__label">お問い合わせの種類</th>
        <th class="admin__label"></th>
      </tr>
{{-- ↑
th: テーブルのセル（セル）を表し、通常は表の見出しに使われる。
class="admin__label": このセルに「admin__label」というクラス名を付け、CSSでスタイル付けをしている。
お名前・性別・メールアドレス・お問い合わせの種類: このセルに表示される文字列。
<th class="admin__label">お名前</th>
<th class="admin__label">性別</th>,
<th class="admin__label">メールアドレス</th>,
<th class="admin__label">お問い合わせの種類</th>,
<th class="admin__label"></th>:

それぞれ「性別」、「メールアドレス」、「お問い合わせの種類」という見出しのセルを定義している。最後の<th></th>は、操作ボタンなどを配置するための空のセルを表していると考えられる。 --}}

{{-- ↓ データベースから取得した $contacts という配列内の各連絡先情報を、
HTMLのテーブル形式で表示するための繰り返し処理を行っている。 --}}
      @foreach($contacts as $contact)
{{-- ↑ LaravelのBladeテンプレートエンジンで、$contacts という配列内の各要素を $contact 変数に代入しながらループ処理を行う。 --}}

      <tr class="admin__row">
  {{--↑ テーブルの行を表す要素。
class="admin__row": この行に「admin__row」というクラス名を付け、CSSでスタイル付けをしている。 --}}

        <td class="admin__data">{{$contact->first_name}}{{$contact->last_name}}</td>

{{-- ↑ テーブルのセル（セル）を表し、お名前を表示する。
class="admin__data": このセルに「admin__data」というクラス名を付け、CSSでスタイル付けを行う。
{{$contact->first_name}}{{$contact->last_name}}**: 現在のループで取り出した連絡先の姓と名を連結して表示する。 --}}

{{-- ↓ 性別を表示するセル。 --}}
        <td class="admin__data">
{{-- ↓ 現在の連絡先の性別が 1 の場合の条件分岐。 --}}
          @if($contact->gender == 1)
          男性
{{-- ↓ 現在の連絡先の性別が 2 の場合の条件分岐。 --}}
          @elseif($contact->gender == 2)
          女性
{{-- ↓ 上記の条件に該当しない場合の処理。 --}}
          @else
          その他
          @endif
        </td>
        
        {{-- ↓ メールアドレスを表示するセル。 --}}
        <td class="admin__data">{{$contact->email}}</td>

        {{-- ↓ お問い合わせの種類を表示するセル。
        現在の連絡先が属するカテゴリの内容を表示する。--}}
        <td class="admin__data">{{$contact->category->content}}</td>
        
        {{-- ↓ 操作ボタンなどを配置するためのセル。 --}}
        <td class="admin__data">
        
          <a class="admin__detail-btn" href="#{{$contact->id}}">詳細</a>
{{-- ↑
・「詳細」というリンクテキストを表示するアンカータグ。
・class="admin__detail-btn": このリンクに「admin__detail-btn」というクラス名を付け、CSSでスタイル付けを行う。
・href="#{{$contact->id}}": リンク先のURLを指定する。ここでは、現在の連絡先のIDを元に、リンク先のフラグメント（ページ内リンク）を指定している

※  ループ処理: @foreach を使用して、配列内のデータを繰り返し処理する。
    条件分岐: @if, @elseif, @else, @endif を使用して、性別の表示を条件分岐する。
    リンク: a タグを使用して、詳細画面へのリンクを作成する。 --}}
        </td>
      </tr>



{{-- ↓ モーダルウィンドウ（ポップアップウインドウ)を定義。 --}}
      <div class="modal" id="{{$contact->id}}">
{{-- ↑
・div class: モーダルウィンドウ全体のコンテナ要素。
・class="modal": このdiv要素に「modal」というクラス名を付け、CSSのスタイル付けを行う。
・id="{{$contact->id}}": このモーダルウィンドウの一意な識別子として、現在の連絡先のIDを割り当てている。 --}}


        <a href="#!" class="modal-overlay"></a>
{{-- ↑
・a: アンカータグだが、実際にはリンクとして機能せず、モーダルウィンドウの背景を暗くするオーバーレイ要素として使用される。
・href="#!": 空のリンクとして設定されている。
・class="modal-overlay": この要素に「modal-overlay」というクラス名を付け、CSSのスタイル付けを行う。--}}

        <div class="modal__inner">
{{-- ↑   モーダルウィンドウの内容を配置するためのコンテナ要素。
・class="modal__inner": このdiv要素に「modal__inner」というクラス名を付け、CSSのスタイル付けを行う。 --}}

          <div class="modal__content">
{{-- ↑ モーダルウィンドウのメインコンテンツを配置するためのコンテナ要素。
・class="modal__content": このdiv要素に「modal__content」というクラス名を付け、CSSでモーダルウィンドウのコンテンツ部分のスタイルを定義する。 --}}

            <form class="modal__detail-form" action="/delete" method="post">
{{-- ↑
・form: フォーム要素。このフォームは、おそらくモーダルウィンドウ内で削除処理を行う。
・class="modal__detail-form": このフォームに「modal__detail-form」というクラス名を付け、CSSでフォームのスタイルを定義する。
・action="/delete": フォーム送信先のURLを指定している。
・method="post": フォームの送信方法をPOSTメソッドに設定している。 --}}
             @csrf
{{-- ↑ LaravelのBladeテンプレートエンジンで提供されるディレクティブ。
CSRF (Cross-Site Request Forgery) 攻撃を防ぐためのトークンを自動的にフォームに挿入する。 --}}

              <div class="modal-form__group">
{{-- ↑ フォーム内の要素をグループ化するためのコンテナ要素。
・class="modal-form__group": このdiv要素に「modal-form__group」というクラス名を付け、CSSでフォーム要素のグループのスタイルを定義する。 --}}

                <label class="modal-form__label" for="">お名前</label>
{{-- ↑ フォーム要素のラベル。
・class="modal-form__label": このラベルに「modal-form__label」というクラス名を付け、CSSでラベルのスタイルを定義するために使用される。
・for="": ラベルが関連付けられているフォーム要素のIDを指定するが、ここでは空になっている --}}

{{-- ↓ 連絡先のお名前を表示する段落要素。 --}}
                <p>{{$contact->first_name}}{{$contact->last_name}}</p>
              </div>

              {{-- ↓ Webページ上で、特定のユーザー($contactという変数で表されている。)の性別を表示するためのもの。 --}}
              <div class="modal-form__group">
{{-- ↑ このdiv要素は、性別に関する情報をグループ化するためのコンテナ。 --}}

                <label class="modal-form__label" for="">性別</label>
{{-- ↑ 「性別」というラベルを表示する。 --}}

{{-- ↓ 性別の値を表示する部分。 --}}
                <p>

                  @if($contact->gender == 1)
                  男性
                  @elseif($contact->gender == 2)
                  女性
                  @else
                  その他
                  @endif
                </p>
{{-- ↑ $contact->genderは、データベースなどから取得したユーザーの性別データ。
もし、$contact->genderが 1 であれば、"男性"と表示。
      $contact->genderが 2 であれば、"女性"と表示。
      ＠else:上記の条件に当てはまらない場合は、その他と表示。--}}
              </div>


{{-- ↓ Webページ上で、特定のユーザー（$contactという変数で表されている）のメールアドレスを表示するためのもの。 --}}

{{-- ↓ このdiv要素はメールアドレスに関する情報をグループ化するコンテナ。 --}}
              <div class="modal-form__group">

{{-- ↓ "メールアドレス"というラベルを表示する。
・<p>: メールアドレスの値を表示する部分。
・$contactは、データベースなどから取得したユーザーの情報が入っているオブジェクト。
・->emailの部分で、そのオブジェクトからメールアドレスの値を取り出し、この位置に表示する。--}}
                <label class="modal-form__label" for="">メールアドレス</label>
                <p>{{$contact->email}}</p>
              </div>


{{-- ↓ このdiv要素は、電話番号に関する情報をグループ化するコンテナ。 --}}
              <div class="modal-form__group">
{{-- ↓ "電話番号"というラベルを表示する。
・<p>: 電話番号の値を表示する部分。
・$contactは、データベースなどから取得したユーザーの情報が入っているオブジェクト。
・->tellの部分で、そのオブジェクトから電話番号の値を取り出し、この位置に表示する。--}}
                <label class="modal-form__label" for="">電話番号</label>
                <p>{{$contact->tell}}</p>
              </div>




{{-- ↓ このdiv要素は、住所に関する情報をグループ化するコンテナ。 --}}
              <div class="modal-form__group">
{{-- ↓ "住所"というラベルを表示する。
・<p>: 住所の値を表示する部分。
・$contactは、データベースなどから取得したユーザーの情報が入っているオブジェクト。
・->addressの部分で、そのオブジェクトから住所の値を取り出し、この位置に表示する。--}}
                <label class="modal-form__label" for="">住所</label>
                <p>{{$contact->address}}</p>
              </div>



{{-- ↓ このdiv要素は、お問い合わせの種類に関する情報をグループ化するコンテナ。 --}}
              <div class="modal-form__group">
{{-- ↓ "お問い合わせの種類"というラベルを表示する。
・<p>: お問い合わせの種類の値を表示する部分。
・$contactは、データベースなどから取得したユーザーの情報が入っているオブジェクト。
・->categoryの部分で、そのオブジェクトからお問い合わせの種類の値を取り出し、
さらに->contentで、その内容（例えば、「商品に関する質問」、「サービスに関する問い合わせ」など）を取り出して、この位置に表示する。--}}
                <label class="modal-form__label" for="">お問い合わせの種類</label>
                <p>{{$contact->category->content}}</p>
              </div>

{{-- ※
オブジェクト指向:
$contact->categoryのように、オブジェクトの属性にアクセスする方法を
オブジェクト指向と言う。
$contactというオブジェクトの中に、categoryという属性があり、
そのcategoryもまた、contentという属性を持っていることを示している。

データベースとの関係:
通常、$contactの情報はデータベースに保存されており、
$contactオブジェクトはデータベースから取得したデータを元に生成される。

categoryは、問い合わせの種類をあらかじめ定義しておいたもので、
データベースの別のテーブルと関連付けられていることが多い。 --}}


{{-- ↓ Webページ上で、特定のユーザー（$contactという変数で表されている）が、
問い合わせフォームに入力した具体的な内容を表示するためのもの。 --}}

{{-- ↓ このdiv要素は、お問い合わせ内容に関する情報をグループ化するコンテナ。 --}}
              <div class="modal-form__group">
{{-- ↓
・"お問い合わせ内容"というラベルを表示する。
・<p>: 実際にユーザーが入力したお問い合わせ内容を表示する部分。
・{{$contact->detail}}:
$contactは、データベースなどから取得した問い合わせの情報が入っているオブジェクト。
->detailの部分で、そのオブジェクトからユーザーが入力した具体的なお問い合わせ内容を取り出し、この位置に表示する。 --}}
                <label class="modal-form__label" for="">お問い合わせ内容</label>
                <p>{{$contact->detail}}</p>
              </div>
{{-- ※
このコードは、ユーザーが問い合わせフォームに入力した内容（質問や要望など）をデータベースから取得し、そのまま表示している。

例えば、ユーザーが「商品の配送が遅れているのですが、いつ届きますか？」という内容を問い合わせフォームに入力した場合、
$contact->detailの値は
「商品の配送が遅れているのですが、いつ届きますか？」となり、
「お問い合わせ内容：商品の配送が遅れているのですが、いつ届きますか？」と表示される --}}


{{-- ↓
このコードは、Webページ上で、特定のデータ（この場合は$contactという変数で表されるお問い合わせ情報など）を削除するためのボタンを作成している。 --}}
              <input type="hidden" name="id" value="{{ $contact->id }}">
{{-- ↑   ※ 隠し入力フィールド
type="hidden": この入力フィールドは、ユーザーには表示されないが、
フォーム送信時にサーバーに送信される。
name="id": この入力フィールドの名前を"id"としている。
value="{{ $contact->id }}": この入力フィールドの値として、$contactという変数のid属性の値を設定している。これは、削除するデータの一意な識別子として使用される。 --}}

              <input class="modal-form__delete-btn btn" type="submit" value="削除">
{{-- ↑ type="submit": このボタンをクリックすると、フォームが送信される。
・value="削除": ボタンに表示される文字列を"削除"としている。 --}}
            </form>
          </div>

{{-- ↓ Webページ上で、特定の要素を閉じるための「×」ボタンのような機能を持つリンクを作成している。 --}}
          <a href="#" class="modal__close-btn">×</a>
{{-- ↑
・<a>タグ:
このタグは、ハイパーリンクを作成するためのHTMLタグ。通常、クリックすると
別のページに遷移するが、この場合はhref="#"とすることで、
現在のページ内で処理が行われるように設定されている。
・class="modal__close-btn":  このクラスに、CSSでスタイル付けしている。--}}

        </div>
      </div>
      @endforeach
      {{-- ↑ PHPのBladeテンプレートエンジンを使用している場合に、ループ処理の終了を示すタグ。@endforeachが使われていることから、このコードはループ処理の中で複数回実行されていると考えられる。
      例えば、複数のモーダルウィンドウを表示する場合などに利用される。--}}
    </table>
  </div>
</div>

</div>
@endsection