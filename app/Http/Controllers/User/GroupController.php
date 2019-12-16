<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    //
  public function talk()
  {
    return view('user.group.talk');
  }

  public function edit()
  {
    return view('user.group.edit');
  }
}
 