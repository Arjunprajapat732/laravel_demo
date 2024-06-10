<?php

namespace App\Http\Controllers\Account;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PusherController extends Controller
{
    public function index(){
        return view('account.pusher.index');
    }

    public function fetchMessages(){
      return Message::with('user')->get();
    }

    public function sendMessage(Request $request){
      $user = Auth::user();

      $message = $user->messages()->create([
        'message' => $request->input('message')
      ]);

      return ['status' => 'Message Sent!'];
    }
}