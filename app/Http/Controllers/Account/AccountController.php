<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard()
    {
        return view('account.body.app');
    }

    public function index()
    {
        return view('account.dashboard.index');
    }
}
