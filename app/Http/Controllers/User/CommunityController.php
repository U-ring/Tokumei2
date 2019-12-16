<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    //
    public function talk()
    {
      return view('user.community.talk');
    }
}
