<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view("login/index", []);
    }
    public function register(Request $request)
    {
        return view("login/register", []);
    }
    public function unregister(Request $request)
    {
        return view("login/unregister", []);
    }
}