<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\Follow;
use \App\Community;

class Cmessage extends Model
{
    //
    protected $fillable = ['user_id','community_id','image_path','message'];

    public function user()//1メッセージで1ユーザーしか取れないから、メソッド名は単数系
    {
      return $this->belongsTo('App\User');
    }

    public function getName($userId)
    {
      return User::where('id','$userId')->name->get();
    }

    public function community()//ここもuser()同様。
    {
      return $this->belongsTo('\App\Community');
    }
}
