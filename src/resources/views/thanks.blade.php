@extends('layouts.app')
{{-- layouts/app.blade.phpファイルのレイアウトを継承する --}}


{{-- ↓の@section('css') と @endsectionで 囲われた部分が、
layouts/app.blade.php の @yield('css')に 埋め込まれる --}}
@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css')}}">
@endsection


{{-- ↓の@section('content') と @endsectionで囲われた部分が、
layouts/app.blade.phpの@yield('content')に埋め込まれる --}}
@section('content')

<div class="thanks-page">
{{-- ↑ 完了ページ全体を囲む要素。このクラス名でCSSのスタイル付けを行う。 --}}

  <div class="thanks-page__inner">
    {{-- ↑ メインのコンテンツ領域を囲む要素。このクラス名でCSSのスタイル付けを行う。 --}}
    <p class="thanks-page__message">お問い合わせありがとうございました</p>

    <form class="thanks-page__form" action="/" method="get">
{{-- ↑ フォームを表すform要素。
action="/":フォームを送信した時に遷移するURLを指定。
ここでは「/」ルートディレクトリ(トップページ)に設定。
method="get"：フォームの送信方法をGETメソッドに設定。 --}}

      <button class="thanks-page__btn btn">HOME</button>
    {{-- ↑ button要素に「thanks-page__btn」と
     「btn」というクラス名を付けている。
     「HOME」という文字列が
     ボタンに表示され、クリックすると、上のform要素のaction属性で指定されたURL（ここでは「/」トップページ）に遷移する。 --}}
    </form>
  </div>
</div>

<div class="thanks-page-bg__inner">
  {{-- ↑ 背景部分の領域を囲む要素。このクラス名でCSSのスタイル付けを行う。 --}}
  <span class="thanks-page-bg__text">Thank you</span>
{{-- ↑ このspan要素はインライン要素で、背景部分に表示されるテキストを囲んでいる。このクラス名でCSSのスタイル付けを行う。「Thank you」という文字列を表示。 --}}

</div>
@endsection