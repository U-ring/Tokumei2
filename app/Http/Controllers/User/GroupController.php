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
use App\Message;

class GroupController extends Controller
{
    //
  public function add()
    { 
      $user = Auth::user();
      $users = $user->mutual_follows();
      // $users = User::all();
      // return view('user.group.create',['user'=>$user,'users'=>$users]);
      return view('user.group.create',['users'=>$users]);
    }  
    
  public function create(Request $request)
    {
      $this->validate($request, Group::$rules);
      $group = new Group;
      $form = $request->name;
      
      $group->name = $form;
      // dd($request);
       
      $me = Auth::user();
      $group->user_id = $me->id;
       
      $group->save();
      
      $user = new User;
      // $user = $request->user_id;この2行はダメな例。$userのidカラムに$request->user_idを代入できていない。↓が正しい。
      // $user = User::where('id',$request->user_id);エラー：Call to undefined method Illuminate\Database\Eloquent\Builder::groups()
      
      $me->groups()->attach($group->id);
      foreach($request->user_id as $item){
        
        $user->id=$item;
        $user->groups()->attach($group->id);
      }
      
      
      return redirect('user/group/create');
    }
    
  public function talk(Request $request)
  { 
    $group = Group::find($request->id);
    $users = $group->users()->get();
    // $messages = Message::where('group_id',$request->id)->get();
    // dd($messages);
    return view('user.group.talk', ['users' => $users, 'group' => $group]);
  }
  
  public function send(Request $request)
  { 
    $this->validate($request, ['message'=>'required']);
    $user = Auth::user();
    $message = new Message;
    $form = $request->all();
    if (isset($form['image'])) {
      $path = $request->file('image')->store('public/image');
      $message->image_path = basename($path);
    } else {
      $message->image_path = null;
    }
    
    unset($form['_token']);
    
    unset($form['image']);
    
    $message->user_id = $user->id;
    $message->fill($form);
    $message->save();
    
    return redirect()->action('User\GroupController@talk',['id'=> $request->group_id]);
  }
  
  public function getMessage()
  {
    $messages = Message::where('group_id','1')->get();
    $json = ["messages" => $messages];
    dd($json);
    return response()->json($json);
  }

  public function message()
  {
    $group = Group::find(1);
    return view('user.group.message',['group' => $group]);
  }

  public function edit(Request $request)
  { 
    $user = Auth::user();
    $group = Group::find($request->id);
    // dd($group);
    // if (empty($group)) {
    //   abort(404);
    // }
    $members = $group->users()->get();
    // $users = $group->users;
    $users = $user->mutual_follows();
    
    // dd($members);
    return view('user.group.edit', ['group_form' => $group,'user' => $user, 'members'=>$members, 'users' =>$users]);
  }
  
  public function update(Request $request)
  {
    $this->validate($request, Group::$rules);
    $group = Group::find($request->id);
    // $group_form = $request->all();
    // unset($group_form['_token']);
    $user = new User;//ユーザーを新しく作成する時に使うのが、このインスタンス化のコード。
    // dd($group_form);
    // if(!empty($group_form['member_id'])){
    //   foreach($group_form['member_id'] as $value){//['member_id']これは連想配列の書き方。
    //     $user->id=$value;
    //     $user->groups()->detach($group->id);
    //   }
    // }
    
    // if(!empty($group_form['user_id'])){  
    //   foreach($group_form['user_id'] as $value){
    //     $user->id=$value;
    //     // dd($value);
    //     $user->groups()->attach($group->id);
    //   }
    // }
    
    if(!empty($request->member_id)){
      foreach($request->member_id as $value){//['member_id']これは連想配列の書き方。
        $user->id=$value;
        $user->groups()->detach($group->id);
      }
    }
    
    if(!empty($request->user_id)){  
      foreach($request->user_id as $value){
        $user->id=$value;
        // dd($value);
        $user->groups()->attach($group->id);
      }
    }
    
    $group->name = $request->name;
    // $group->fill($group_form)->save();
    $group->save();
    
    return redirect('user/home/guest');
  }
}
 