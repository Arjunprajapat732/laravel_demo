<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function h_one(Request $request){
    $destination = $request->destination;
    // dd($destination);
    return view('dashboard.section_dashboard', compact('destination'));
    }
}
