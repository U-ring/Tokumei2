<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Abraham\TwitterOAuth\TwitterOAuth;

class OAuthLoginController extends Controller //←Controllerが規定クラス
{
  
  public function twitterCallback(Request $request)
    {
        $oauth_token = session('oauth_token');
        $oauth_token_secret = session('oauth_token_secret');

        # request_tokenが不正な値だった場合エラー
        if ($request->has('oauth_token') && $oauth_token !== $request->oauth_token) {
            return Redirect::to('/login');
        }

        # request_tokenからaccess_tokenを取得
        $twitter = new TwitterOAuth(
            $oauth_token,
            $oauth_token_secret
        );
        $token = $twitter->oauth('oauth/access_token', array(
            'oauth_verifier' => $request->oauth_verifier,
            'oauth_token' => $request->oauth_token,
        ));

        # access_tokenを用いればユーザー情報へアクセスできるため、それを用いてTwitterOAuthをinstance化
        $twitter_user = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            $token['oauth_token'],
            $token['oauth_token_secret']
        );

        # 本来はアカウント有効状態を確認するためのものですが、プロフィール取得にも使用可能
        $twitter_user_info = $twitter_user->get('account/verify_credentials');
        dd($twitter_user_info);
    }
  
   //ログインボタンからリンク
   public function socialLogin($social)
   {
       return Socialite::driver($social)->redirect();
   }
   //Callback処理
   public function handleProviderCallback($social)
   {
       // ユーザ属性を取得
       try {
           $userSocial = Socialite::driver($social)->user();//throwもsocialiteが行う。
           \Debugbar::error($userSocial);
       } catch (Exception $e) {
           // OAuthによるユーザー情報取得失敗
           return redirect()->route('/')->withErrors('ユーザー情報の取得に失敗しました。');
       }
       //メールアドレスで登録状況を調べる
       $user = User::where(['email' => $userSocial->getEmail()])->first();
      
       //メールアドレス登録の有無で条件分岐
       if($user){
           //email登録がある場合の処理            
           //ログイン
           Auth::login($user);
       }else{
           //メールアドレスがなければユーザ登録
           $newuser = new User;
           $newuser->name = $userSocial->getName();
           $newuser->email = $userSocial->getEmail();
       
           // 画像の取得
        //   $img = file_get_contents($userSocial->avatar_original);
        //   if ($img !== false) {
        //       $file_name = $userSocial->id . '_' . uniqid() . '.jpg';
        //       Storage::put('public/profile_images/' . $file_name, $img);
        //       $newuser->avatar = $file_name;
        //   }
        $newuser->avatar=$userSocial->user['profile_image_url_https'];
           //sns特有の情報を条件分岐で取得する
           switch ($social) {
               case "facebook":
                   //$newuser->name = $userSocial->getNickname();  ////ここから
                   $newuser->facebook_id = $userSocial->getId(); //
               case "twitter":
                   //$newuser->name = $userSocial->getNickname();  ////
                   $newuser->twitter_id = $userSocial->getId();  ////ここまで、変更。
               break;
           }
           //ユーザ作成     
           $newuser->save();
           //ログイン
           Auth::login($newuser);
       }
       //topページにリダイレクト
       return redirect('/user/profile/home'); 
   }
   
       public function twitter()
        {
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
    
            return redirect('user/follow');
        }

   
   public function getFollowList(Request $request)
    {
      $twitter = new TwitterOAuth(
            config('twitter.consumer_key'),
            config('twitter.consumer_secret'),
            config('twitter.access_token'),
            config('twitter.access_token_secret')
        );

      
      $params = [
    'cursor' => '-1',
    'count' => '200',
    'skip_status' => 'true',
    'screen_name' => '...',
      ];
      $followers = [];
      
      do {
          $response = $connection->get('followers/list', $params);
          if (!isset($response->users)) {
              echo 'TwitterAPIの制限がかかっちゃってる！ごめんなさい！' . PHP_EOL;
              break;
          }
          $followers = array_merge($followers, $response->users);
      } while ($params['cursor'] = $response->next_cursor_str);
      
      // ↑ $params['cursor'] に代入しつつカーソルの値をループ条件に使う
       
    }
    
}


