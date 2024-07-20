<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //最初の登録画面
    public function index(Request $request)
    {
        // 非ログイン時はアカウント登録フォーム、ログイン時はログアウトボタンを表示するといった切り替えのため session に保存された login_id を取得
        $loginId = $request->session()->get("login_id" , null);
        $variables = [
            "isLoginActive" => isset($loginId)
        ];

        return view("login/index", compact("variables"));
    }

    
    public function register(Request $request)
    {
        //formからの入力情報の取得
        $id = $request->input("id");
        $password = $request->input("password");

        // 同一 id の登録が既に存在するかチェックするため、指定された id をもとに DB Record を取得する。
        // select count(*) は where 条件に合致するレコード数を取得する SQL Query。
        $oldRecords = DB::connection('mysql')->select("select count(*) from users where id = '" . $id . "'");
        
        // sql query に失敗している場合、処理失敗として終了する
        if (count($oldRecords) == 0) {
            return response("処理中に問題が発生しました。<a href='/login'>前のページへ戻る</a>");
        }
        
        //count(*)の値が0より大きい場合は同一 idのrecordが存在することになるため、処理を終了する
        $record = (array)($oldRecords[0]);
        if ($record["count(*)"] > 0) {
            return response("すでに存在するアカウントidです。<a href='/login'>前のページに戻る</a>");
        }

        //ここまで正常に処理が進んだら既存のレコードも存在しないため、入力情報をもとにレコードを追加する
        DB::connection("mysql")->insert("insert into users (id,password) values ('" . $id . "','" . $password . "')");
        
        //ログインidを取得するため、保存したレコード情報を取得する
        $records = DB::connection('mysql')->select("select * from users where id = '" . $id . "'");
        
        //recordが取得できなかったら何等かのエラーが発生しているため処理を終了する
        if (count($records) == 0) {
            return response("ユーザーデータの登録処理中に問題が発生しました。 <a href='/login'>前のページに戻る</a>");
        }
        
        //sessionにログインしているuser idを保存
        $request->session()->put("login_id", $records[0]->id);
        
        return response("登録が完了しました。<a href='/login'>前のページへ戻る</a>");
    }

    
    public function sign_in(Request $request)
    {
        $id = $request->input("id");
        $password = $request->input("password");

        $records = DB::connection('mysql')->select("select * from users where id = '" . $id . "' and password = '" . $password . "'");
        if (count($records) == 0) {
            return response("処理中に問題が発生しました。 <a href='/login'>前のページに戻る</a>");
        }

        $request->session()->put("login_id", $records[0]->id);
        return response("ログインが完了しました。 <a href='/login'>前のページに戻る</a>");
    }

    public function unregister(Request $request)
    {
        //sessionに保存したidの値をnullに変更する
        $request->session()->flush();
        return response("ログアウトが完了しました。<a href='/login'>前のページへ戻る</a>");
    }
}