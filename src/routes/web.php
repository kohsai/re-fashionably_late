<?php


// 概要
// このコードは、ウェブサイトのページとそれに対応する処理を定義している。
// トップページ、確認画面、完了画面、管理者ページ、検索機能、データ削除、データエクスポートの処理が、それぞれのコントローラーのメソッドに割り当てられている。
// また、管理者ページ、検索、削除、エクスポートの機能は認証が必要なため、ミドルウェアで保護されている。


// ↓ ContactControllerというコントローラークラスを使用することを宣言。
use App\Http\Controllers\ContactController;
// ↓ ルーティング機能を提供する Route ファサードを使用することを宣言。
use Illuminate\Support\Facades\Route;


Route::get('/', [ContactController::class, 'index']);

Route::get('/register', [ContactController::class, 'register']);

Route::get('/login', [ContactController::class, 'login']);

Route::get('/admin', [ContactController::class, 'admin']);

Route::get('/confirm', [ContactController::class, 'confirm']);

Route::get('/contact', [ContactController::class, 'contact']);

Route::get('/thanks', [ContactController::class, 'store']);




Route::post('/register', [ContactController::class, 'register'])->name('register');

Route::post('/login', [ContactController::class, 'login']);


// ↓  /confirmというURLに対してPOSTメソッドでアクセスされた場合に、ContactControllerクラスのconfirmメソッドを実行することを定義
Route::post('/confirm', [ContactController::class, 'confirm']);


// ↓   /thanksというURLに対してPOSTメソッドでアクセスされた場合に、ContactControllerクラスのstoreメソッドを実行することを定義
Route::post('/thanks', [ContactController::class, 'store']);


// ↓ このコードブロックは、認証が必要なルートをグループ化している。

// ↓ Route::middleware('auth'): このグループ内のルートに認証ミドルウェアを適用する。認証が必要なユーザーのみアクセスできるようになる。
Route::middleware('auth')->group(function () {

    // ↓  /adminというURLにGETメソッドでアクセスされた場合に、ContactControllerクラスのadminメソッドを実行
    Route::get('/admin', [ContactController::class, 'admin']);

    // ↓  /searchというURLにGETメソッドでアクセスされた場合に、ContactControllerクラスのsearchメソッドを実行
    Route::get('/search', [ContactController::class, 'search']);

    // ↓  /deleteというURLに対してPOSTメソッドでアクセスされた場合に、ContactControllerクラスのdestroyメソッドを実行
    Route::post('/delete', [ContactController::class, 'destroy']);

// ↓   /exportというURLに対してPOSTメソッドでアクセスされた場合に、ContactControllerクラスのexportメソッドを実行
    Route::post('/export', [ContactController::class, 'export']);


});