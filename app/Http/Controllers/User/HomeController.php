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
use App\GroupUser;

class HomeController extends Controller
{
    
    public function guest()
  {
    $user = Auth::user();
    $users = $user->mutual_follows();
    
    // $groups = GroupUser::groupsOnUser(Auth::id());
    // $groups = $user->groups;//ログイン中のユーザーの所属グループを取得。
    $groups = $user->groups;//このデータはcollectionである。
    // dd($groups);
    
    return view('user.home.guest',['user' => $user ,'users' => $users ,'groups'=>$groups]);
    // return view('user.home.guest',['user' => $user ,'users' => $users ]);//テスト用
  }
    
    public function facebook()
    {
      return view('user.home.facebook');
    }
    
    public function twitter()
  { 
    
    if (!isset($_SESSION['$followers'])){
      //twitterアクション挿入
       $twitter = new TwitterOAuth(
                config('twitter.consumer_key'),
                config('twitter.consumer_secret')
            );
            # 認証用のrequest_tokenを取得
            # このとき認証後、遷移する画面のURLを渡す
            $token = $twitter->oauth('oauth/request_token', array(
                'oauth_callback' => config('twitter.callback_url')
            ));
    
            # 認証画面で認証を行うためSessionに入れる
            session(array(
                'oauth_token' => $token['oauth_token'],
                'oauth_token_secret' => $token['oauth_token_secret'],
            ));
    
            # 認証画面へ移動させる
            ## 毎回認証をさせたい場合： 'oauth/authorize'
            ## 再認証が不要な場合： 'oauth/authenticate'
            $url = $twitter->url('oauth/authenticate', array(
                'oauth_token' => $token['oauth_token']
            ));
       
       //followアクション挿入
       $twitter = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            config('twitter.access_token'),
            config('twitter.access_token_secret')
        );

      
      $params = [
    'cursor' => '-1',
    'count' => '20',
    'skip_status' => 'true',
    //'screen_name' => '...',
    'user_id' => Auth::user()->twitter_id,
      ];
      $followers = [];
 
        do {
          $response = $twitter->get('friends/list', $params);
          
          if (!isset($response->users)) {
              echo 'TwitterAPIの制限がかかっちゃってる！ごめんなさい！' . PHP_EOL;
                break;
          }
         // \Log::error($response->users); 
         // \Log::channel('errorlog')->getLogger()->error($response->users);
          $followers = array_merge($followers, $response->users);
        //   $params['cursor'] = $response->next_cursor_str;
        //   $response = $twitter->get('friends/list', $params);
          
        //   if (!isset($response)) {
        //       echo 'TwitterAPIの制限がかかっちゃってる！ごめんなさい！' . PHP_EOL;
        //       //break;
        //   }
          
        // $followers = array_merge($followers, $response->users);
          
        } while ($params['cursor'] = $response->next_cursor_str);
       //↑ $params['cursor'] に代入しつつカーソルの値をループ条件に使う
       
       \Session::put('followers', '$followers');
    }else{
       \Session::get('followers', 'followを取得できませんでした。');   
    }
    
    $friend = User::where('id')->get();
    \Debugbar::info($friend); 
    
    return view('user.home.twitter',["followers" => $followers, "user" => Auth::user() ,"friend" => $friend]);
  }
  
  public function talk()
  {
    return view('user.home.talk');
  }
  
  public function followings($id)//$idという引数を撮ってるからアクションではない。使われていない。
    {
        $user = User::find($id);
        // $followings = $user->followings()->paginate(9);
        $followings = Auth::user()->followings;
        // User::find(Auth::id())->follows;
        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);
       
        return view('user.home.followings', $data);
    }
    
  public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers();
        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);
        return view('user.home.followers', $data);
    }
}
