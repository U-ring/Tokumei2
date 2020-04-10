<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Umessage;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //
  public function index(Request $request)
  {
      $me = Auth::user();
      $friends = $me->mutual_follows();

      $cond_name = $request->cond_name;

      if ($cond_name !='') {
        $users = User::where('name', $cond_name)->get();
        // dd($users);
      }else {

       
      }

      return view('user.user.index', ['friends' => $friends, 'users' => $users, 'cond_name' => $cond_name]);
  }

  public function talk(Request $request)
  {
    $user = User::find($request->id);
    // $users = $group->users()->get();
    // $messages = Message::where('group_id',$request->id)->get();
    // dd($messages);
    return view('user.user.talk',['user' => $user]);
  }

  public function getMessageU(Request $request)
  {

    $id = $request->input('id');

    $query = Umessage::query();
    $query->where('user_id',Auth::id());
    $query->where('talk_user_id',$id);
    $umessages = $query->get();

    // $messageRecords = Umessage::where('user_id',Auth::id())->get();

    $messages = [];

    foreach($umessages as $umessage)
    {
      $item = [
        'name' => $umessage->user->name,
        'message' => $umessage->message,
        'image' => $umessage->image_path,
        'created_at' => $umessage->created_at
        ];

      $messages[] = $item;
    }

    //モデルの関連づけメソッドは()いらない。✖︎user()

    $json = ["messages" => $messages];
    // dd($json);
    return response()->json($json);
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
  $message = new Umessage;

  $message->user_id = $user->id;

  $message->talk_user_id = $_POST['user_id'];

  $messagef = $_POST['message'];
  $message->message = $messagef;

  $form = $request->all();
  // Log::debug($message);
  if (isset($form['image'])) {
    // \Log::info($image);
    $path = $request->file('image')->store('public/image');
    $message->image_path = basename($path);
  } else {
    $message->image_path = null;
  }

  $message->save();
}

  public function edit()
  {
    return view('user.user.edit');
  }

  public function Terms()
  {
    return view('user.user.TermsOfService');
  }
}
