<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    { 
        $cond_name = $request->cond_name;
        
        if ($cond_name !='') {
          $users = User::where('name', $cond_name)->get();
          // dd($users); 
        }else {
         
         $users = User::all();
        }
        
        return view('home', ['users' => $users, 'cond_name' => $cond_name]);
    }
}
