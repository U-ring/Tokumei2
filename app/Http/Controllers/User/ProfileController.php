<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use Abraham\TwitterOAuth\TwitterOAuth;

class ProfileController extends Controller
{
    //
  public function login()
  {
    return view('user.profile.login');
  }
  
  public function edit()
  {
    $user = Auth::user();
    
    return view('user.profile.edit',['user'=>$user]);
  }
  
  public function update(Request $request)
  {
    $user = Auth::user();
    
    if(!empty($request->name)){
      $user->name = $request->name;
    }
    
    if(!empty($request->text)){
      $user->text = $request->text;
    }
    
    $profile_form = $request->all();
    
    $user->fill($profile_form)->save();
    return redirect('user/home/guest');
  }
  
  public function delete()
  {
    
  }
}
