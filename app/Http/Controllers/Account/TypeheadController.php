<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TypeheadController extends Controller
{
    public function index(Request $request){
        return view('account.typeheadjs.index');
    }
}
