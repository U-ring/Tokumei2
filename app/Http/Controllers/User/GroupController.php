<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use App\Follow;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Group;

class GroupController extends Controller
{
    //
  public function add()
    { 
      $user = Auth::user();
      $users = $user->mutual_follows();
      // $users = User::all();
      return view('user.group.create',['user'=>$user,'users'=>$users]);
    }  
    
  public function create(Request $request)
    {
      $this->validate($request, Group::$rules);
      $group = new Group;
      $form = $request->name;
      
      $group->name = $form;
      // dd($request);
       
      $group->save();
      
      $user = new User;
      // $user = $request->user_id;この2行はダメな例。$userのidカラムに$request->user_idを代入できていない。↓が正しい。
      // $user = User::where('id',$request->user_id);エラー：Call to undefined method Illuminate\Database\Eloquent\Builder::groups()
      $user->id=$request->user_id;
      $user->groups()->attach($group->id);
      
      return redirect('user/group/create');
    }
    
  public function talk()
  {
    return view('user.group.talk');
  }

  public function edit()
  {
    return view('user.group.edit');
  }
}
 