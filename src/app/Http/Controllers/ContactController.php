<?php

// ↓ Laravelアプリケーションのコントローラーファイルの先頭部分で、使用するクラスや名前空間を定義

//  ↓  名前空間の宣言: このコードは、現在のファイル内のクラスが App\Http\Controllers という名前空間に属することを宣言している。
// これにより、他のクラスを参照する際に、完全な名前空間を指定する必要がなくなり、コードの簡潔化と読みやすさが向上する。
namespace App\Http\Controllers;


// ↓  ContactRequestクラスのインポート: このコードは、App\Http\Requests\ContactRequest というクラスをインポートしている。これは、フォームリクエストと呼ばれるもので、フォームから送信されたデータの検証を行うために使用される。
use App\Http\Requests\ContactRequest;


// ↓  Categoryモデルのインポート: このコードは、App\Models\Category というモデルクラスをインポートする。このモデルは、カテゴリーに関するデータの操作を行うために使用される。
use App\Models\Category;


// ↓  Contactモデルのインポート: このコードは、App\Models\Contact というモデルクラスをインポートする。このモデルは、問い合わせに関するデータの操作を行うために使用される。
use App\Models\Contact;


// ↓  Requestクラスのインポート: このコードは、Illuminate\Http\Request というクラスをインポートする。このクラスは、HTTPリクエストに関する情報を扱うために使用される。
use Illuminate\Http\Request;



// ↓  Dateファサードのインポート: このコードは、Illuminate\Support\Facades\Date というファサードをインポートする。ファサードは、クラスの静的メソッドを簡単に呼び出すための便利な方法を提供している。この場合は、日付や時刻に関する操作を行うために使用される。
use Illuminate\Support\Facades\Date;



// ↓  StreamedResponseクラスのインポート: このコードは、Symfony\Component\HttpFoundation\StreamedResponse というクラスをインポートする。このクラスは、大量のデータを効率的に出力する際に使用される。
use Symfony\Component\HttpFoundation\StreamedResponse;




// ↓  class ContactController extends Controller は、お問い合わせに関する処理を行うためのコントローラーを定義する最初のステップといえる。このコントローラークラスを継承することで、Laravelが提供するコントローラーの機能を継承し、独自のロジックを実装することができる。

// ↓  ContactController という名前のコントローラークラスを定義している。
// このクラスは、Laravelの Controller クラスを継承している。
class ContactController extends Controller

{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }





    //  ↓   index という名前のパブリックなメソッドを定義している。
    // このメソッドは、通常、ルートからアクセスされた際に呼び出される。
    public function index()
    {
        // ↓  Category モデルからすべてのカテゴリーデータを取得し、$categories 変数に代入している。
        $categories = Category::all();


        //  ↓ view 関数を使用して、contact という名前のビューファイルを表示する。
        // compact('categories') は、$categories 変数をビューに渡すための配列を作成する。これにより、ビュー内で $categories 変数としてアクセスできるようになる。
        return view('contact', compact('categories'));
    }


    // ↓  このコードは、Laravelの ContactController クラス内の confirm メソッド。お問い合わせフォームの入力内容を受け取り、カテゴリー情報を取得し、それらの情報を confirm ビューに渡す処理を行っている。通常、このビューでは、お問い合わせフォームの入力内容を確認するための処理を行う。


    // ↓  confirm という名前のパブリックなメソッドを定義している。
    // このメソッドは、フォームから送信されたデータを受け取るために、ContactRequest クラスのインスタンスをパラメーターとして受け取る。
    public function confirm(ContactRequest $request)
    {
        // ↓  フォームから送信されたすべてのデータを $contacts 変数に代入する。
        $contacts = $request->all();
        
        // ↓  フォームから送信された category_id を使って、該当するカテゴリー情報を Category モデルから取得し、$category 変数に代入する。
        $category = Category::find($request->category_id);
        //  ↓  confirm という名前のビューファイルを表示する。
        // compact('contacts', 'category') は、
        // $contacts と $category 変数をビューに渡すための配列を作成する。これにより、ビュー内でこれらの変数にアクセスできる。
        return view('confirm', compact('contacts', 'category'));
    }


    // ↓   このコードは、Laravelの ContactController クラス内の store メソッド。お問い合わせフォームの送信処理の一部を担っており、ユーザーが「戻る」ボタンを押した場合の動作を定義している。

    // 具体的な動作
    // ユーザーがお問い合わせフォームに入力し、「戻る」ボタンを押す。
    // back パラメーターが store メソッドに送信される。
    // if 文の条件が真となり、redirect メソッドが実行される。
    // 入力内容を保持したまま、お問い合わせフォームの最初のページに戻る。


    // ↓  store という名前のパブリックなメソッドを定義している。
    // このメソッドは、フォームから送信されたデータを受け取るために、ContactRequest クラスのインスタンスをパラメーターとして受け取る。
    // 通常、このメソッドで、データベースへの保存などの処理が行われる。
    public function store(ContactRequest $request)
    {


        // ↓  $request オブジェクトから back というキーを持つデータが存在するかチェックする。これは、通常、フォームに「戻る」ボタンを設置し、そのボタンが押された際に back という名前の hidden フィールドが送信されるように設定されている場合に利用される。
        // back キーが存在した場合、以下の処理が行われる。
        // ・redirect('/'): ルート（/）にリダイレクトする。つまり、お問い合わせフォームの最初のページに戻る。
        // ・withInput(): フォームに入力された値を保持したままリダイレクトする。これにより、ユーザーが「戻る」ボタンを押した際に、再度入力し直す必要がなくなる。
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }


        // ↓  このコードは、Laravelの ContactController クラス内の store メソッドの一部で、電話番号を結合し、お問い合わせ情報をデータベースに保存する処理を行っている。

        // ↓  フォームから送信された tel_1, tel_2, tel_3 の値を結合して、tell というキーでリクエストデータに追加する。これは、電話番号を一つの文字列として扱うために必要な処理である。
        $request['tell'] = $request->tel_1 . $request->tel_2 . $request->tel_3;


        //   ↓   Contact::create()・・Contact モデルを使用して、新しいお問い合わせレコードを作成する。
        //  $request->only([ ... ])・・フォームから送信されたデータのうち、指定したキーのみを抽出する。抽出されたデータは、Contact モデルのインスタンスを作成するために使用される。

        Contact::create(
            $request->only([
                'category_id',
                'first_name',
                'last_name',
                'gender',
                'email',
                'tell',
                'address',
                'building',
                'detail'
            ])
        );

        // ↓  このコードは、Laravelの ContactController クラス内の store メソッドの一部で、お問い合わせ情報の保存処理が成功した後、ユーザーに感謝のメッセージを表示するための処理を行っている。
        // return: 関数から値を返すことを示す。
        // view('thanks'): thanks という名前のビューファイルを返す。これは、ブラウザに表示するHTMLのテンプレート。
        return view('thanks');
    }



    // ↓  このコードは、Laravelの ContactController クラス内の admin メソッド。管理者向けの画面を表示するための処理を行っている。

    // ↓ 具体的な動作
    // 管理者権限を持つユーザーが,、管理者画面にアクセスする。
    // admin メソッドが実行される。
    // お問い合わせデータとカテゴリーデータが取得される。
    // admin ビューが表示され、取得したデータが利用可能になる。
    // admin という名前のパブリックなメソッドを定義。

    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        $csvData = Contact::all();
        return view('admin', compact('contacts', 'categories', 'csvData'));
    }
    // ↑
    // ・$contacts = Contact::with('category')->paginate(7);
    //  Contact モデルから、カテゴリー情報を含めたお問い合わせデータを7件ずつページネーションして取得し、$contacts 変数に代入している。

    // ・$categories = Category::all();
    // 全てのカテゴリー情報を取得し、$categories 変数に代入している。

    // ・$csvData = Contact::all();
    // 全てのお問い合わせ情報を取得し、$csvData 変数に代入する。これは、CSV出力などに使用するデータと思われる。

    // return view('admin', compact('contacts', 'categories', 'csvData'));
    // admin という名前のビューファイルを表示する。

    // compact('contacts', 'categories', 'csvData') は、$contacts, $categories, $csvData 変数をビューに渡すための配列を作成している。



    // このコードは、Laravelの ContactController クラス内の search メソッド。
    // お問い合わせデータの検索機能を実装している。

    // ↓  search という名前のパブリックなメソッドを定義している。
    // Request オブジェクトを受け取ることで、リクエストデータにアクセスできる。
    public function search(Request $request)
    {
        // ↓  リクエストに reset パラメータが含まれているかチェックする。これは、検索条件のリセットボタンを押したときに送信されるパラメータ。
        if ($request->has('reset')) {
            // ↓  検索条件のリセットボタンが押された場合、管理者画面にリダイレクトする。withInput() メソッドにより、元の検索条件を保持したままリダイレクトする。
            return redirect('/admin')->withInput();
        }
        // ↓  Contact モデルのクエリビルダを取得し、$query 変数に代入
        $query = Contact::query();

        // ↓  getSearchQuery メソッドを使用して、検索条件をクエリに追加する。
        $query = $this->getSearchQuery($request, $query);

        // ↓  検索結果を7件ずつページネーションして、$contacts 変数に代入。
        $contacts = $query->paginate(7);

        // ↓  全ての検索結果を取得し、$csvData 変数に代入
        $csvData = $query->get();

        // ↓  全てのカテゴリー情報を取得し、$categories 変数に代入
        $categories = Category::all();

        // ↓  admin ビューを表示し、$contacts, $categories, $csvData 変数を渡す。
        return view('admin', compact('contacts', 'categories', 'csvData'));
    }

    //  ↓  Laravelの ContactController クラス内の destroy メソッド。
    //     お問い合わせデータを削除する処理を行っている。
    // 具体的な動作
    // 削除したいお問い合わせの行にある「削除」ボタンをクリックする。
    // destroy メソッドが実行され、リクエストデータから id が取得される。
    // 指定された id のお問い合わせデータが削除される。
    // 管理者画面にリダイレクトされる。


    // ↓  destroy という名前のパブリックなメソッドを定義。
    // Request オブジェクトを受け取ることで、リクエストデータにアクセスできる。
    public function destroy(Request $request)
    {
        // ↓  Contact モデルから、リクエストで渡された id に一致するお問い合わせデータを取得し、delete() メソッドで削除する。
        Contact::find($request->id)->delete();
        // ↓  削除処理が完了後、管理者画面にリダイレクトする。
        return redirect('/admin');
    }


    // ↓  このコードは、Laravelの ContactController クラス内の export メソッドの一部で、CSVデータを出力するための準備を行っている。

    // 具体的な処理の流れ
    // データベースから問い合わせデータを取得し、配列に変換する。
    // CSVファイルのヘッダー情報を定義する。
    // CSVファイルを作成し、ヘッダーとデータを書き込む。
    // 生成されたCSVファイルをダウンロードさせるための処理を行う。
    // このコードをベースに、CSVファイルの出力処理を実装していくことになる。

    public function export(Request $request)
    {
        $query = Contact::query();

        $query = $this->getSearchQuery($request, $query);

        // ↓  データベースから取得したお問い合わせデータを配列形式に変換して、$csvData 変数に代入する。これはCSVファイルに出力するために必要な形式である。
        $csvData = $query->get()->toArray();


        // ↓  CSVファイルのヘッダー部分に使用するカラム名を配列として定義している。この配列の内容がCSVファイルの最初の行になる。

        $csvHeader = [
            'id',
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tell',
            'address',
            'building',
            'detail',
            'created_at',
            'updated_at'
        ];



        // このコードは、Laravelの ContactController クラス内の export メソッドの一部で、CSVファイルを出力するための処理を行っている。


        // ↓  StreamedResponse クラスのインスタンスを作成する。これは、大量のデータを効率的に出力するためのクラス。
        // use ($csvHeader, $csvData) は、クロージャ内で $csvHeader と $csvData 変数を使用できるようにする。
        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {

            // ↓  fopen 関数を使用して、出力ストリームを開く。'php://output' は、ブラウザに出力することを意味する。
            $createCsvFile = fopen('php://output', 'w');

            // ↓  文字コードの変換を行う。CSVファイルの文字コードを SJIS-win に変換。
            mb_convert_variables('SJIS-win', 'UTF-8', $csvHeader);

            // ↓  CSVファイルのヘッダー行を出力する。
            fputcsv($createCsvFile, $csvHeader);

            //  ↓    お問い合わせデータに対してループ処理を行う。
            foreach ($csvData as $csv) {


                // ↓  created_at カラムのデータを Asia/Tokyo タイムゾーンに変換し、指定したフォーマットに整形している。
                $csv['created_at'] = Date::make($csv['created_at'])->setTimezone('Asia/Tokyo')->format('Y/m/d H:i:s');
                // ↓  updated_at カラムのデータを Asia/Tokyo タイムゾーンに変換し、指定したフォーマットに整形している。
                $csv['updated_at'] = Date::make($csv['updated_at'])->setTimezone('Asia/Tokyo')->format('Y/m/d H:i:s');
                // ↓   各お問い合わせデータをCSV形式で出力する。
                fputcsv($createCsvFile, $csv);
            }

            //  ↓  fopen で開いた CSV ファイルをクローズする。
            // これにより、ファイルへの書き込みを終了する。

            fclose($createCsvFile);
            // ↓  200: HTTP ステータスコード。200 は成功を表す。
            // [ ... ]: レスポンスヘッダー。
            // ・'Content-Type' => 'text/csv': レスポンスのコンテンツタイプを CSV として指定している。
            // ・'Content-Disposition' => 'attachment; filename="contacts.csv"': ファイルをダウンロードさせるためのヘッダー。filename でファイル名を指定。
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);
        // ↓  作成した StreamedResponse オブジェクトを返す。これにより、ブラウザに CSV ファイルがダウンロードされる。
        return $response;
    }

    // ↓  このコードは、Laravelのコントローラー内で定義されたプライベートメソッド getSearchQuery。このメソッドは、検索条件に基づいてデータベースクエリを構築する。

    // ↓  プライベートメソッド getSearchQuery を定義。
    // 引数として、Request オブジェクトとクエリビルダを受け取る。
    private function getSearchQuery($request, $query)
    {

        // ↓  リクエストの keyword パラメータが存在し、空でない場合に処理を実行。
        if (!empty($request->keyword)) {

            // ↓  クエリビルダの where メソッドを使用して、クロージャ内で検索条件を定義。
            // クロージャ内の $q は、現在のクエリビルダを表している。
            // use ($request) は、クロージャ内で $request 変数を使用できるようにする。
            $query->where(function ($q) use ($request) {

                // ↓  first_name カラムに対して、like 条件で検索キーワードを含むレコードを検索する。
                // % はワイルドカードで、任意の文字列にマッチする。
                $q->where('first_name', 'like', '%' . $request->keyword . '%')

                    // ↓  last_name カラムに対しても同様の検索条件を追加している。
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')

                    // ↓  email カラムに対しても同様の検索条件を追加します。
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }


        // ↓  このコードは、Laravelのコントローラー内の getSearchQuery メソッドの一部で、検索条件をさらに拡張している。
        // 検索条件として性別、カテゴリー、日付が指定された場合、それらの条件に基づいてデータベースからデータを取得するためのクエリを構築する。

        // ↓  リクエストに gender パラメータがあり、空でない場合、
        if (!empty($request->gender)) {
            // ↓  性別でフィルタリングする。
            $query->where('gender', '=', $request->gender);
        }

        // ↓  リクエストに category_id パラメータがあり、空でない場合、
        if (!empty($request->category_id)) {
            // ↓  カテゴリー ID でフィルタリングする。
            $query->where('category_id', '=', $request->category_id);
        }

        // ↓  リクエストに date パラメータがあり、空でない場合、
        if (!empty($request->date)) {
            // ↓  作成日の日付でフィルタリングする。
            $query->whereDate('created_at', '=', $request->date);
        }
        // ↓  構築されたクエリを返す。
        return $query;
    }
}
