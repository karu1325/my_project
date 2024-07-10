<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampleController extends Controller {
    public function index(Request $request) {
        $sampleTest = "6test";

        $records = DB::connection('mysql')->select("select * from users");
        $name = $records[0]->name;

        $deleteResult = DB::connection("mysql")->delete("delete from users where name = 'cc'");
        dd($deleteResult);
        return view("sample/index" , ["sampleTest" => $sampleTest]);
    }
}