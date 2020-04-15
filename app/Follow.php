<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follow extends Model
{
    //
    public function user()
    {
      return $this->belongsTo('\App\User');
    }

    public function follows()
    {
        // return $this->belongsTo('App\User', 'foreign_key', 'follow_id');
        return User::find($this->follow_id);//Userモデルを使って、followsテーブルからfollow_idをuser_idとして取得する
    }

    //
    public function follower()
    {
        return User::find($this->user_id);
    }
}
