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
  public function profile()
  {
    $user = Auth::user();
    $users = $user->mutual_follows();

    // $groups = GroupUser::groupsOnUser(Auth::id());
    // $groups = $user->groups;//ログイン中のユーザーの所属グループを取得。
    $groups = $user->groups;//このデータはcollectionである。
    // dd($groups);

    return view('user.profile.profile',['user' => $user ,'users' => $users ,'groups'=>$groups]);
    // return view('user.home.guest',['user' => $user ,'users' => $users ]);//テスト用
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

    if(isset($request['avatar'])) {
      $path = $request->file('avatar')->store('/public/image');
      $user->avatar = basename($path);
    }

    // $profile_form = $request->all();
    // $profile_form = $profile_form + array('avatar'=>$user->avatar);
    // dd($profile_form);

    // $user->fill($profile_form)->save();
    $user->save();
    return redirect('/');
  }

  public function delete()
  {

  }
}
