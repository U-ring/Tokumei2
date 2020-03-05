{{-- layouts/talk.blade.phpを読み込む --}}
@extends('layouts.talk')


{{-- talk.blade.php(layouts)の@yield('title')に'匿名トーク'を埋め込む --}}
@section('title', '匿名トーク')

@section('nameOf')
  <p class="h3 mx-auto">{{ $group->name }}</p>
@endsection

@section('message')
 {{-- <table>
     @foreach($group->messages as $message)
     <tr>
         <div class="p-4 row"><td class="font-weight-bold">{{ $message->user->name }}</td>
         <td class="px-4">{{ $message->message }}</td></div>
       @if ($message->image_path)
         <div class="image p-4 row"><td><img src="{{ secure_asset('storage/image/' . $message->image_path) }}" class="rounded"></td></div>
       @endif
         <div class="p-4 row"><td>{{ $message->created_at }}</td></div>
     </tr>
     @endforeach
 </table> --}}
     @foreach($group->messages as $message)
     <div class="container col-md-12">
         <div class="p-4 row">
           <p class="font-weight-bold">{{ $message->user->name }}</p>
           <p class="px-4">{{ $message->message }}</p>
         </div>
        @if ($message->image_path)
         <div class="image px-4 row"><img src="{{ secure_asset('storage/image/' . $message->image_path) }}" class="rounded"></div>
        @endif
        {{ $message->created_at->format('H : i') }}
     </div>
     @endforeach
@endsection

@section('form')
    <form action="{{ action('User\GroupController@send') }}" method="post" class="form-inline d-flex justify-content-between" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row px-2 mx-2">
        <input type="text" class="form-control" name="message">
        </div>
        <div class="py-2 form-group row mx-2">
            <input type="file" class="form-control-file" name="image">{{-- ※name属性あとで弄ろう --}}
        </div>
        <div class="form-group row float-right">
          <input type="hidden" name="group_id" value={{ $group->id }}>    
          <input type="submit" class="btn btn-primary" value="送信する">
        </div>
    </form>
@endsection
