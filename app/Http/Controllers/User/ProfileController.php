<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
  public function login()
  {
    return view('user.profile.login');
  }
  
  public function edit()
  {
    return view('user.profile.edit');
  }
  
  public function add()
  {
    return view('user.profile.add');
  }

  public function home()
  {
    return view('user.profile.home');
  }
  
  public function talk()
  {
    return view('user.profile.talk');
  }
}
