@extends('layouts.app')
{{-- layouts/app.blade.phpファイルのレイアウトを継承する --}}


{{-- ↓の@section('css') と @endsectionで 囲われた部分が、
layouts/app.blade.php の @yield('css')に 埋め込まれる --}}
@section('css') 
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection


    {{--
    div:ブロック要素で、コンテンツをグループ化する。
    form:フォームを作成する。
    label:フォーム要素にラベルを付けるための要素。
    span:インライン要素(行の一部として扱われる。横一列に並ぶ)で、
    テキストの一部をスタイルする。
    --}}


{{-- ↓の@section('content') と @endsectionで囲われた部分が、
layouts/app.blade.phpの@yield('content')に埋め込まれる --}}
    @section('content')

<div class="contact-form">
{{-- ↑　問い合わせフォーム全体のコンテナとなるdiv要素 --}}
        <h2 class="contact-form__heading content__heading">Contact</h2>

        <div class="contact-form__inner">
            {{-- ↑ フォーム全体を収めるdiv要素 --}}
            <form action="confirm" method="POST">
                {{-- ↑ フォームタグで、送信先のURLと送信方法を指定 --}}
                @csrf
                {{-- ↑ 保護のためのトークンを生成する Blade ディレクティブ --}}

                <div class="contact-form__group contact-form__name-group">
                   {{-- ↑ 名前入力欄をグループ化するdiv要素 --}}

                    <label class="contact-form__label" for="name">
                        お名前<span class="contact-form__required">※</span>
                        {{-- ◎ "お名前"というラベルを表示するlabel要素。for="name"属性は、後ろのinput要素のid属性と対応させている。
                        ◎ <span class>・・・※マークを表示するspan要素で、必須(required)項目の意味。 --}}

                    </label>

                    <div class="contact-form__name-inputs">
                        {{-- ↑　名前入力欄をグループ化するコンテナ要素。 --}}
                        <input class="contact-form__input contact-form__name-input" type="text" name="first_name"
                            id="name" value="{{ old('first_name') }}" placeholder="例：山田">
                        <input class="contact-form__input contact-form__name-input" type="text" name="last_name"
                            id="name" value="{{ old('last_name') }}" placeholder="例：太郎">
                        </div>

                        {{--
・input class: 氏名を入力するためのテキストボックス。
・type="text":テキスト入力フィールドであることを指定。
・name="first or last_name":  サーバーサイドで受け取るデータの名前を指定。
・id="name":  JavaScriptなどで要素を参照するための ID を指定。
・value="{{ old('first or last_name') }}":   old関数 ...フォームの再送信時に、入力された値を保持するための Blade ディレクティブ。
・placeholder="例：山田 or 太郎":   入力欄に表示されるヒントテキスト。 --}}


                    <div class="contact-form__error-message">
                {{-- ↑　エラーメッセージを表示するためのコンテナ要素 --}}
                        @if ($errors->has('first_name'))
{{-- bladeディレクティブ。first_nameフィールドにエラーがある場合に条件分岐する。 --}}
                    <p class="contact-form__error-message-first-name">{{ $errors->first('first_name') }}</p>
                        @endif
{{-- ↑ $errors->first('first_name'): first_nameフィールドの最初のエラーメッセージを取得。 --}}

                        @if ($errors->has('last_name'))
                            <p class="contact-form__error-message-last-name">{{ $errors->last('last_name') }}</p>
                        @endif

{{-- ↑ $errors->last('last_name'): last_nameフィールドの最後のエラーメッセージを取得。 --}}

                    </div>
                </div>

                <div class="contact-form__group">
                    {{-- ↑ 性別選択項目をグループ化 --}}
                    <label class="contact-form__label">
                        性別<span class="contact-form__required">※</span>
                    </label>
                    {{-- ↑ 「性別」というラベルを表示。必須項目の表示。 --}}

                    <div class="contact-form__gender-inputs">
                        {{-- ↑ 性別選択オプションをグループ化 --}}
                        <div class="contact-form__gender-option">
                            {{-- ↑ 性別選択の各オプションをグループ化 --}}

                            <label class="contact-form__gender-label">
                    {{-- ↑ ラジオボタンとテキストを含むラベル。 --}}
                                <input class="contact-form__gender-input" name="gender" type="radio" id="male"
                                    value="1" {{ old('gender')==1 || old('gender')==null ? 'checked' : '' }}>
                                <span class="contact-form__gender-text">男性</span>
{{--
・input: ラジオボタン要素。
・class="contact-form__gender-input": スタイルを適用するためのクラス名。
● name="gender": フォーム送信時にデータを送信するための名前。
複数のラジオボタンで同じ名前を付けることで、一択の選択になる。
・type="radio": ラジオボタンであることを指定。
● id="male": ラジオボタンの識別子で、ラベル要素と関連付ける。
・value="1": 選択された場合に送信される値。
● {{ old('gender')==1 || old('gender')==null ? 'checked' : '' }}:
 Bladeテンプレートの構文で、前回の入力値が 1 または null の場合に、
 チェックボックスをデフォルトでチェック。
・span: 「男性」というテキストを表示するための要素。
・class="contact-form__gender-text": スタイルを適用するためのクラス名。--}}

                            </label>
                        </div>

                        <div class="contact-form__gender-option">
                            <label class="contact-form__gender-label">
                                <input class="contact-form__gender-input" type="radio" name="gender" id="female"
                                    value="2" {{ old('gender')==2 ? 'checked' : '' }}>
                                <span class="contact-form__gender-text">女性</span>
                            </label>
                        </div>

                        <div class="contact-form__gender-option">
                            <label class="contact-form__gender-label" for="other">
                                <input class="contact-form__gender-input" type="radio" name="gender" id="other"
                                    value="3" {{ old('gender')==3 ? 'checked' : '' }}>
                                <span class="contact-form__gender-text">その他</span>
                            </label>
                        </div>
                    </div>

{{-- ※ @errorディレクティブは、Laravelのバリデーション機能と連携し、
入力値がバリデーションルールに違反した場合に、エラーメッセージを表示。 --}}


                    <p class="contact-form__error-message">
                        @error('gender')
{{-- ↑ genderフィールドにエラーがある場合、その後のコードブロックを実行 --}}
                            {{ $message }}
                            {{-- ↑ エラーメッセージの内容を出力。 --}}
                        @enderror
                    </p>
                </div>


                <div class="contact-form__group">
                    {{-- ↑ 「メールアドレス」の項目をグループ化。 --}}
                    <label class="contact-form__label" for="email">
                        メールアドレス<span class="contact-form__required">※</span>
                        {{-- ↑ メールアドレスというラベルを表示。必須項目の表示。 --}}
                    </label>
                    <input class="contact-form__input" type="email" name="email" id="email"
                        value="{{ old('email') }}" placeholder="例：test@example.com">
{{-- ↑ 
・type="email": 電子メールアドレスの入力を指定。
・name="email": フォーム送信後にサーバー側で受け取れるように、入力されたデータを識別するための名前を指定。この場合は、"email" 。
・id="email": ラベルの for 属性と一致させることで、ラベルのクリックをこの入力項目に関連付ける。
● value="{{ old('email') }}": 前回の入力値があった場合に、その値をフォームにあらかじめ入力しておくためのもの。old('email') で過去の入力値を取得。
placeholder="例：test@example.com": 入力例を示すヒントテキスト。 --}}


                {{-- ↓ 他項目を参考に。 --}}
                    <p class="contact-form__error-message">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>
                </div>


                <div class="contact-form__group">
                    <label class="contact-form__label" for="tel">
                        電話番号<span class="contact-form__required">※</span>
                    </label>
                    <div class="contact-form__tel-inputs">
                        {{-- ↑ 電話番号の入力欄をグループ化。 --}}
                        <input class="contact-form__input contact-form__tel-input" type="tel" name="tel_1"
                            id="tel" value="{{ old('tel_1') }}">
                        <span>-</span>
                        <input class="contact-form__input contact-form__tel-input" type="tel" name="tel_2"
                            value="{{ old('tel_2') }}">
                        <span>-</span>
                        <input class="contact-form__input contact-form__tel-input" type="tel" name="tel_3"
                            value="{{ old('tel_3') }}">
                    </div>
{{-- ↑
● **input class="contact-form__input contact-form__tel-input" 
type="tel" name="tel_1" id="tel" value="{{ old('tel_1') }}": 電話番号の最初の3桁を入力するテキストボックス。
・span: ハイフン「-」を表示するための要素。
● **input class="contact-form__input contact-form__tel-input" type="tel" name="tel_2" value="{{ old('tel_2') }}": 電話番号の次の4桁を入力する。
・span: ハイフン「-」を表示する。
● **input class="contact-form__input contact-form__tel-input" type="tel" name="tel_3" value="{{ old('tel_3') }}": 電話番号の最後の4桁を入力する。

？？ ３桁、４桁の指定は？？ --}}



                    <p class="contact-form__error-message">
                {{-- ↑ エラーメッセージを表示するためのコンテナ要素。 --}}
                        @if ($errors->has('tel_1'))
        {{-- ↑ tel_1 フィールドにエラーがある場合に実行される条件文。 --}}
                            {{$errors->first('tel_1')}}
        {{-- ↑ tel_1フィールドの最初のエラーメッセージを表示。 --}}
                            @elseif ($errors->has('tel_2'))
        {{-- ↑ tel_1フィールドにエラーがない場合、tel_2フィールドにエラーがあるかチェック。 --}}
                            {{$errors->first('tel_2')}}
                            {{-- ↑ 同上 --}}
                            @else
            {{-- ↑ tel_1 と tel_2の両方にエラーがない場合に実行。 --}}
                            {{$errors->first('tel_3')}}
                            {{-- ↑ 同上 --}}
                            @endif
                            {{-- ↑ 条件文の終了 --}}

{{-- ※ このコードでは、電話番号の3つの入力欄のうち、最初のエラーが見つかった時点で表示を停止する。すべてのエラーを表示したい場合は、@if, @elseif の代わりに @foreach を使用してループ処理を行う。 --}}
                    </p>
                </div>



                <div class="contact-form__group">
                    {{-- ↑ 住所入力欄をグループ化する要素。 --}}
                    <label class="contact-form__label" for="address">
                        住所<span class="contact-form__required">※</span>
                    </label>
                    <input class="contact-form__input" type="text" name="address" id="address"
                        value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
{{-- ↑ 
●label class="contact-form__label" for="address": 住所入力欄のラベル。
「住所」という文字列を表示し、for="address"属性で以下のinput要素と関連付け。
・span class="contact-form__required": 必須項目の表示。
・type="text" テキスト入力の指定。
・name="address" フォーム送信時にサーバー側で「address」でデータを受け取れるよう設定。
・id="address" ラベルの for属性と対応。
・value="{{ old('address') }}：old関数で、前回入力の値（があれば）を初期値として表示。
・placeholder= 入力例。 --}}


                    <p class="contact-form__error-message">
            {{-- ↑ 住所入力にエラーがあった場合、メッセージを表示。 --}}
                        {{-- ↓ 他項目を参考に。 --}}
                        @error('address')
                            {{ $message }}
                        @enderror
                    </p>
                </div>


                <div class="contact-form__group">
                    {{-- ↑ 建物名入力欄をグループ化するための要素。 --}}
                    <label class="contact-form__label" for="building">建物名</label>
                    <input class="contact-form__input" type="text" name="building" id="building"
                        value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101">
{{-- ↑ 
・label class="contact-form__label" for="building": 
建物の名前を入力するためのラベル。「建物名」という文字列を表示し、for="building" 属性で以下のinput要素と関連付け。
・type="text": テキスト入力の指定。
・name="building": フォーム送信時にサーバー側で「building」という名前でデータを受け取れるように設定。
・id="building": ラベルの for 属性と対応しています。
・value="{{ old('building') }}": 前回入力された建物名があれば、その値を初期値として表示。
・placeholder= 入力例。 --}}
                </div>


                <div class="contact-form__group">
        {{-- ↑ お問い合わせの種類の項目選択をグループ化する。 --}}
                    <label class="contact-form__label" for="">
                        お問い合わせの種類<span class="contact-form__required">※</span>
                    </label>

                    <div class="contact-form__select-inner">
                        {{-- ↑ セレクトボックスを配置するコンテナ。 --}}
                        <select class="contact-form__select" name="category_id" id="">
            {{-- ↑ お問い合わせの種類を選択するセレクトボックス。
            name="category_id":フォーム送信時にサーバー側で「category_id」という名前でデータを受け取れるように設定。--}}


                            <option disabled selected>選択してください</option>
                 {{-- ↑ 初期状態で選択されているオプション。 --}}

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id')== $category->id ? 'selected' : '' }}>{{ $category->content }}
                                </option>
                            @endforeach
                        </select>
{{-- ↑     ？？？？？？？？？？？？？？？？？？？？？？？？？？

● @foreach ($categories as $category):
$categories という変数に格納されたカテゴリの一覧をループ処理。
※ $categories 変数は、サーバー側で定義されたカテゴリの一覧であることが前提！

● option value="{{ $category->id }}" {{ old('category_id')== $category->id ? 'selected' : '' }}>{{ $category->content }}</option: 各カテゴリのオプションを表示。
● value="{{ $category->id }}": オプションの値としてカテゴリのIDを設定。
・{{ old('category_id')== $category->id ? 'selected' : '' }}: 前回選択されたカテゴリがあれば、そのオプションを自動的に選択。
● {{ $category->content }}: オプションの表示テキストとしてカテゴリの内容を表示。 --}}

                    </div>
                    <p class="contact-form__error-message">
{{-- ↑ お問い合わせの種類入力にエラーがあった場合、メッセージを表示。

流れとして、
ユーザーが「お問い合わせの種類」を選択せずにフォームを送信しようとした場合、
システムが category_id に値が入力されていないことを検知し、エラーとする。
このコードが実行され、「お問い合わせの種類を選択してください」といったエラーメッセージが画面上に表示される。--}}

                        @error('category_id')
{{--↑ category_id フィールド（お問い合わせの種類を選択するセレクトボックス）にエラーが発生した場合に、このブロック内のコードが実行 --}}
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="contact-form__group">
            {{-- ↑ お問い合わせ内容を入力するためのコンテナ要素。 --}}
                    <label class="contact-form__label" for="detail">
                        お問い合わせ内容<span class="contact-form__required">※</span>
                    </label>

                    <textarea class="contact-form__textarea" name="detail" id="" cols="30" rows="10"
                        placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>

{{--
・label class="contact-form__label" for="detail":
お問い合わせ内容を入力するためのラベル。
「お問い合わせ内容」という文字列を表示し、for="detail" 属性で以下のtextarea要素と関連付け。
・span class="contact-form__required": 必須項目の表示。
textarea class="contact-form__textarea" : お問い合わせ内容を入力するテキストエリア。
name="detail": フォーム送信時にサーバー側で「detail」という名前でデータを受け取れるように設定。
cols="30" rows="10": テキストエリアの初期表示サイズを幅30文字、高さ10行に設定。
placeholder= 入力例。
{{ old('detail') }}": 前回入力されたお問い合わせ内容があれば、その値を初期値として表示。 --}}


                    <p class="contact-form__error-message">
            {{-- ↑ エラーメッセージを表示するための要素。 --}}
                        @error('detail')
            {{-- ↑ detailフィールドにエラーが発生した場合、
                    このブロック内のコードが実行される。 --}}
                            {{ "$message" }}
                        @enderror
                    </p>
                </div>

                <input class="contact-form__btn btn" type="submit" value="確認画面">
    {{-- ↑ フォームを送信するためのボタン。 
    流れとして、ユーザーが「お問い合わせ内容」を入力せずに
    フォームを送信しようとすると、システムは detail フィールドに値が入力されていないことを検知し、エラーとする。
    エラーメッセージ部分のコードが実行され、「お問い合わせ内容を入力してください」といったエラーメッセージが画面上に表示される。
    エラーがなければ、「確認画面」ボタンを押すと、入力内容を確認する画面に遷移する。 --}}
            </form>
        </div>
    </div>
    @endsection