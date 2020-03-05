<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFollowController extends Controller
{
    //
    public function store($id)
    {
        \Auth::user()->follow($id);
        return back();
    }    

    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
