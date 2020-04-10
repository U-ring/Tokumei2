<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use \App\Follow;
use \App\Community;
use \App\Group;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followings()
    {
        return $this->hasMany('App\Follow');
        // return $this->hasMany('App\Follow')->where('user_id',Auth::id())->get();
    }

    public function followers()
    {
        // return $followers = $this->where(follow_id,Auth::id())->get();
        return Follow::where('follow_id',Auth::id())->get();
    }

    public function mutual_follows()
    {
      // 自分がフォローした相手のリストを取得
      // $follows = $this->followings();
      // $follows = Follow::where('user_id',Auth::id())->get();
      $follows = $this->followings()->get();
      // 自分をフォローしている相手のリストを取得
      $followers = $this->followers();
      // dd($followers[0]);
      // 戻り値の配列を初期化(ここに、相互フォローの相手リストが入る)
      $ret = [];

      // 自分がフォローしているFollowデータを一つずつ取り出す
      foreach($follows as $follow) {

        // 自分をフォローしているFollowデータを一つずつ取り出す

        foreach($followers as $follower) {
          // 自分がフォローしている相手がフォロワーにいれば、相互フォロー
          if ($follow->follow_id == $follower->user_id) {
              $ret[] = $follower->follower();//ここが、Follow.phpのfollowsになっていた。
              break;
          }
        }
      }
      return $ret;//閉じかっこがズレていた。->mutual_follows();すると、$ret配列を返すよ、という意味。
     }

    public function is_following($userId)
    {
        return Follow::where('follow_id', $userId)->exists();
    }

    public function follow($userId)//仮引数＝この関数の中では、$userIdという名前で使われる
    {
      // フォロー済みではない、かつフォロー相手がユーザ自身ではない場合、フォロー
      if( $this->id != $userId && !$this->is_following($userId) ) {
        // $this->followings()->attach($userId);
        $follow = new Follow;
        $follow->user_id = Auth::id();
        $follow->follow_id = $userId;
        $follow->save();
      }

    }

    public function unfollow($userId)
    {
      //whereは複数(配列で)取得してしまう。firstを書いたのは、 「最初の要素を返す」とするため。
        if( $this->id != $userId && null != ($follow = Follow::where('user_id', Auth::id())->where('follow_id', $userId)->first()) ){
          Follow::destroy($follow->id);
        }
    }

    public function communities()
    {
      return $this->belongsToMany('\App\Community','community_user');
    }

    public function groups()
    {
      return $this->belongsToMany('\App\Group','group_user');
    }

    public function messages()
    {
      return $this->hasMany('App\Message');
    }

}
