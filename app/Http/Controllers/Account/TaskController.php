<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;

class TaskController extends Controller
{
	public function index(){
		$tasks = Tasks::paginate(10);
		return view('account.tasks.index', compact('tasks'));
	}

	public function edit(Request $request) {
		if($request->id) {
			$tasks = Tasks::find($request->id);
		}else{
			$tasks = new Tasks();
		}
		return view('account.tasks.edit', compact('tasks'));
	}

	public function store(Request $request) {
		if($request->id) {
			$task = Tasks::find($request->id);
		}else{
			$task = new Tasks();
		}
		$task->title = $request->title;
		$task->description = $request->description;
		$task->user_id = '1';
		// $task->user_id = auth()->id();
		$task->save();
		if($request->id) {
			return back()->with('success', 'task edited successfully');
		}else{
			return back()->with('success', 'task added successfully');
		}
	}

	public function delete(Request $request) {
		Tasks::find($request->id)->delete();

		return back()->with('success', 'task deleted successfully');
	}

}