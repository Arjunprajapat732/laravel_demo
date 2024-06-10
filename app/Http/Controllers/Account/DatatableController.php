<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;

class DatatableController extends Controller
{
    public function index(Request $request)
    {  
        if($request->type === 'normal'){
            $datas = Tasks::all();
            return view('account.data_tables.normal', compact('datas'));
        }

        return view('account.data_tables.index');
    }
}
