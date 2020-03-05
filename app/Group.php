<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\Follow;

class Group extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
      'name' => 'required'
      );
    
    public function users()
    {
      // return $this->belongsToMany('\App\User')->using('App\GroupUser','group_user');
      return $this->belongsToMany('\App\User');
    }
    //groupモデルとmessageモデルの関連が抜けている。
    public function messages()
    {
      return $this->hasMany('\App\Message');
    }
    
}
