<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Follow;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Group;
use App\Message;
use Illuminate\Support\Facades\Log;
use Storage; 

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
      $this->validate($request, [
        'name' => 'required',
        'user_id' => 'required',
        ]);
      $group = new Group;
      $form = $request->name;

      $group->name = $form;
      // dd($request);

      $me = Auth::user();
      $group->user_id = $me->id;

      if(isset($request['image'])) {
        // $path = $request->file('avatar')->store('/public/image');
        // $group->image = basename($path);
        
        $path = Storage::disk('s3')->putFile('/',$request['image'],'public');
        $group->image = Storage::disk('s3')->url($path);

      }

      $group->save();

      $user = new User;
      // $user = $request->user_id;この2行はダメな例。$userのidカラムに$request->user_idを代入できていない。↓が正しい。
      // $user = User::where('id',$request->user_id);エラー：Call to undefined method Illuminate\Database\Eloquent\Builder::groups()
      $hash = Hash::make($me->name);
      $nickname = substr($hash,-10);
      // Log::debug($nickname);
      $me->groups()->attach($group->id, ['nickname' => $nickname]);

      foreach($request->user_id as $item){

        $user->id=$item;
        $member = User::find($item);
        $hashn = Hash::make($member->name);
        $nickn = substr($hashn,-10);
        $user->groups()->attach($group->id,['nickname' => $nickn]);
      }
      //66行目'nickname'同じだからエラーくるかも？

      return redirect('home');
    }

  public function talk(Request $request)
  {
    $group = Group::find($request->id);
    // $users = $group->users()->get();
    // $messages = Message::where('group_id',$request->id)->get();
    // dd($messages);
    return view('user.group.talk',['group' => $group]);
  }

    public function message()
  {
    $group = Group::find(1);

    return view('user.group.chat',['group' => $group]);
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
    // Log::info("★★★★★★★★★");
    $message->user_id = $user->id;
    $message->fill($form);
    $message->save();

    return redirect()->action('User\GroupController@talk',['id'=> $request->group_id]);//この行がリロードを引き起こす。
  }

  public function getMessage(Request $request)
  {
    // $messages = Message::where('group_id','1')->get();
    $id = $request->input('id');
    // $id = 3;
    $messageRecords = Message::where('group_id',$id)->get();
    $group = Group::find($id);
    $members = $group->users()->get();
    foreach($members as $member){
      $memId[] = $member->id;
      $nName[] = $member->pivot->nickname;
    }
    $nickname = array_combine($memId,$nName);
    // Log::debug($nickname);

    $messages = [];

    foreach($messageRecords as $messageRecord)
    {

      // $ass = $messageRecord->user_id;
      $name = $nickname[$messageRecord->user_id];
      // Log::debug($name);
      $item = [
        'name' => $name,
        'message' => $messageRecord->message,
        'image' => $messageRecord->image_path,
        'created_at' => $messageRecord->created_at
        ];

      $messages[] = $item;
    }
    //モデルの関連づけメソッドは()いらない。✖︎user()

    $json = ["messages" => $messages];
    // dd($json);
    return response()->json($json);
  }

  public function sendM(Request $request)
  {
    $this->validate($request, ['message'=>'required']);
    $user = Auth::user();
    $message = new Message;

    $message->user_id = $user->id;
    // // $message_req = filter_input(INPUT_POST, 'message');
    // $message_req = $request->all();

    // Log::debug($request);
    // $message->message = $message_req->message;//$message_reqが受け取れてない可能性
    $message->group_id = 1;
    // // $message->fill($form);
    // $message->save();
    // Log::info("★★★★★★★★★");
    // Log::info($messagef);

     ini_set('display_errors','no');
      if($_POST){
      	$messagef = $_POST['message'];
      	$message->message = $messagef;
      	Log::debug($messagef);
      	$message->save();
      }
  }

    public function sendC(Request $request)
  {
    // $file_tmp  = $_FILES["image"]["tmp_name"];
    // $file_save = "public/image" . $_FILES["image"]["name"];
    // $result = @move_uploaded_file($file_tmp, $file_save);

    // if ( $result === true ) {
    //     $message->image_path = basename($file_save);
    // } else {
    //     echo "UPLOAD NG";
    // }
    $upfile = $request;
    // Log::info(var_dump($request));
    $this->validate($request, ['message'=>'required']);
    $user = Auth::user();
    $message = new Message;

    $message->user_id = $user->id;

    $message->group_id = $_POST['group_id'];

    $messagef = $_POST['message'];
    $message->message = $messagef;

    $form = $request->all();
    // Log::debug($message);
    if (isset($form['image'])) {
      // \Log::info($image);
      // $path = $request->file('image')->store('public/image');
      // $message->image_path = basename($path);
        $path = Storage::disk('s3')->putFile('/',$request['image'],'public');
        $message->image_path = Storage::disk('s3')->url($path);

    } else {
      $message->image_path = null;
    }

    $message->save();
  }

  public function edit(Request $request)
  {
    $user = Auth::user();
    $group = Group::find($request->id);
    $members = $group->users()->get();
    // dd($group);
    // if (empty($group)) {
    //   abort(404);
    // }



    foreach($members as $member){
      $membersnames[] = $member->pivot->nickname;
      $membersnames[] = $member->pivot->user_id;
      Log::debug($membersnames);
    }

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

    return redirect('home');
  }

  public function withdraw(Request $request)
  {
   $group = new Group;
   $group->id = $request->id;
   $user = Auth::user();

   $user->groups()->detach($group->id);

   return redirect('home');
  }
}
