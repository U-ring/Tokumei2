<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
  public function talk()
  {
    return view('user.user.talk');
  }
  
  public function edit()
  {
    return view('user.user.edit');
  }
}
