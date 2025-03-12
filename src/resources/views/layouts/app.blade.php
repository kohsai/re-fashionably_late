<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>re-fashionably_late</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>

{{-- ↑
<head>タグ内に
文字エンコードの指定
Viewportの設定（レスポンシブデザイン）
タイトルの指定
外部CSSの読み込み（ress.min.css, common.css）
@yield ディレクティブを使って、継承可能な部分を示している --}}

<body>
  <div class="app">
    <header class="header">
      <h1 class="header__heading">FashionablyLate</h1>
      @yield('link')
      {{-- ↑ @yield('link'):
      この部分には、ナビゲーションリンクなどのコンテンツが埋め込まれる。
      これは、テンプレートエンジン（おそらくBlade）の機能で、
      他のファイルからコンテンツを挿入するための場所を示す。 --}}
    </header>
    <div class="content">
      @yield('content')
      {{-- ↑ テンプレートエンジンを使って他のファイルからコンテンツを挿入。 --}}
    </div>
  </div>
</body>

</html>