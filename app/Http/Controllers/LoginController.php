<?php

namespace App\Http\Controllers;
use App\Http\Controllers\LoginController;

use App\Models\User;
use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
      return view('auth.register');
    }
    public function register_store(Request $request){
        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('psw')); // Assuming password is hashed
        $user->save();

        return redirect()->route('login')->with('success', 'User registered successfully');
    }

    public function signup_user(Request $request){
        return view('dashboard.dashboard_main', compact('notesdata'));
    }

    public function login(Request $request){
        return view('auth.login');
        
    }
    public function login_user(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if ($email && $password) {
            $user = User::where('email', $email)
                ->where('password', bcrypt($password))
                ->first();

            if ($user) {
                return redirect()->route('dashboard');
            }
        }
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

}
