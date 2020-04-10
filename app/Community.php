<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\Cmessage;
use \App\Follow;

class Community extends Model
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

      public function cmessages()
      {
        return $this->hasMany('\App\Cmessage');
      }
}
