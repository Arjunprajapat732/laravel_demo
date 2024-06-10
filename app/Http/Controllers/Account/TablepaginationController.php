<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;

class TablepaginationController extends Controller
{
	public function index(){
		$tasks = Tasks::paginate(10);
		return view('account.table_pagination.index', compact('tasks'));
	}
}