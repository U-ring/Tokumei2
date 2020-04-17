<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use App\Community;
use App\Cmessage;
use Illuminate\Support\Facades\Log;
use Storage; 

class CommunityController extends Controller
{
    //
    public function add()
      {
        $user = Auth::user();
        $users = $user->mutual_follows();
        // $users = User::all();
        // return view('user.group.create',['user'=>$user,'users'=>$users]);
        return view('user.community.create',['users'=>$users]);
      }

      public function create(Request $request)
        {
          $this->validate($request, [
            'name' => 'required',
            'user_id' => 'required',
            ]);
          $community = new Community;
          $form = $request->name;

          $community->name = $form;
          // dd($request);

          $me = Auth::user();
          $community->user_id = $me->id;

          if(isset($request['image'])) {
            // $path = $request->file('avatar')->store('/public/image');
            // $community->image = basename($path);
            $path = Storage::disk('s3')->putFile('/',$request['image'],'public');
            $community->image = Storage::disk('s3')->url($path);

          }

          $community->save();

          $user = new User;
          // $user = $request->user_id;この2行はダメな例。$userのidカラムに$request->user_idを代入できていない。↓が正しい。
          // $user = User::where('id',$request->user_id);エラー：Call to undefined method Illuminate\Database\Eloquent\Builder::groups()

          $me->communities()->attach($community->id);
          foreach($request->user_id as $item){

            $user->id=$item;
            $user->communities()->attach($community->id);
          }


          return redirect('home');
        }

        public function edit(Request $request)
        {
          $user = Auth::user();
          $community = Community::find($request->id);

          $members = $community->users()->get();
          $friends = $user->mutual_follows();
          foreach ($members as $member) {
            $cId[] = $member->id;
          }

          foreach ($friends as $friend) {
            $fId[] = $friend->id;
          }

          $users = User::whereIn('id',$fId)->whereNotIn('id',$cId)->get();

          return view('user.community.edit', ['community_form' => $community,'user' => $user, 'members'=>$members, 'users' =>$users]);
        }

        public function update(Request $request)
        {
          $this->validate($request, Community::$rules);
          $community = Community::find($request->id);
          // $group_form = $request->all();
          // unset($group_form['_token']);
          $user = new User;//ユーザーを新しく作成する時に使うのが、このインスタンス化のコード。

          if(!empty($request->member_id)){
            foreach($request->member_id as $value){//['member_id']これは連想配列の書き方。
              $user->id=$value;
              $user->communities()->detach($community->id);
            }
          }

          if(!empty($request->user_id)){
            foreach($request->user_id as $value){
              $user->id=$value;
              // dd($value);
              $user->communities()->attach($community->id);
            }
          }

          if(isset($request['image'])) {
            $path = $request->file('image')->store('/public/image');
            $community->image = basename($path);
          }

          $community->name = $request->name;
          // $group->fill($group_form)->save();
          $community->save();

          return redirect('home');
        }

        public function withdraw(Request $request)
        {
         $community = new Community;
         $community->id = $request->id;
         $user = Auth::user();

         $user->communities()->detach($community->id);

         return redirect('home');
        }

        public function talk(Request $request)
        {
          $community = Community::find($request->id);
          // $users = $group->users()->get();
          // $messages = Message::where('group_id',$request->id)->get();
          // dd($messages);
          return view('user.community.talk',['community' => $community]);
        }

        public function getMessageC(Request $request)
        {
          // $messages = Message::where('group_id','1')->get();
          $id = $request->input('id');
          $messageRecords = Cmessage::where('community_id',$id)->get();

          $messages = [];

          foreach($messageRecords as $messageRecord)
          {
            $item = [
              'name' => $messageRecord->user->name,
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

        public function sendC(Request $request)
      {
        $upfile = $request;
        // Log::info(var_dump($request));
        $this->validate($request, ['message'=>'required']);
        $user = Auth::user();
        $message = new Cmessage;

        $message->user_id = $user->id;

        $message->community_id = 1;

        $messagef = $_POST['message'];
        $message->message = $messagef;

        $form = $request->all();
        // Log::debug($request->image);
        if (isset($form['image'])) {
          // \Log::info($image);
          $path = $request->file('image')->store('public/image');
          $message->image_path = basename($path);
        } else {
          $message->image_path = null;
        }

        $message->save();

      }

}
