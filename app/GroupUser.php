<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use \App\Group;
use \App\User;

class GroupUser extends Model
{
    // 指定グループに所属するユーザーのリストを取得
    public static function usersInGroup($groupId){
      
      return GroupUser::where('group_id',$this->groupsOnUser()->get(group_id));
    }
    
    //指定ユーザーが所属するグループのリストを取得
    public static function groupsOnUser($user_id) {
      
      // return GroupUser::where('user_id',Auth::id())->get();
      return User::where('id',GroupUser::where('user_id',Auth::id()))->get();
    }
}
