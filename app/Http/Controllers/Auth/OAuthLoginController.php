<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class OAuthLoginController extends Controller
{
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
           $userSocial = Socialite::driver($social)->user();
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
}


