<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

class TaskController extends Controller
{
    public function notestore(Request $request){
        $notes = new Notes;
        $notes ->note = $request->note;
        $notes ->message = $request->message;
        $notes->save();

        $notesdata = Notes::all();
        return view('tasks.form', compact('notesdata'));
    }
}
