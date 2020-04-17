@extends('layouts.home')

@section('title.コミュニティ編集')

@section('content')
<div class="p-4 mx-auto">
  <p class="h3 font-weight-bold">コミュニティ編集</p>
  <div class="row m-4">
   <form action="{{ action('User\CommunityController@update') }}" method="post" class="col-md-12" enctype="multipart/form-data" >
     @csrf
     @if (count($errors) > 0)
     <ul>
       @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
       @endforeach
     </ul>
     @endif
     <div class="form-group row">
       <input type="file" class="form-control-file" name="image">
     </div>
     <div class="form-group mx-auto row test">
       <p class="font-weight-bold px-4">メンバーを退会させる</p>
       <table>
         <tbody>
           @foreach($members as $member)
            <tr>
             <td>
                <input class="form-check-input" type="checkbox" value={{$member->id}} name="member_id[]">
                <label class="form-check-label" for="customCheck1">
                  {{ $member->name}}
                </label>
             </td>
            </tr>
           @endforeach
         </tbody>
       </table>
     </div>
     <div class="form-group mx-auto row">
       <p class="font-weight-bold px-4">メンバーを招待する</p>
       <table>
         <tbody>
           @foreach($users as $user)
           <tr>
             <td>
               <input class="form-check-input" type="checkbox" name="user_id[]" value={{$user->id}}>
               <label for="">
                 {{ $user->name }}
               </label>
             </td>
           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
     <div class="form-group float-right pb-6 row">
        <input type="text" class="m-2" name="name"/ value="{{ $community_form->name }}">
        <input type="hidden" name="id" value="{{ $community_form->id }}">

        {{ csrf_field() }}
        <button type="submit" class="m-2 btn btn-primary">編集を完了する</button>
     </div>
   </form>
   <div>
     <form action="{{ action('User\CommunityController@withdraw')}}" method="post">
       @csrf
       <button type="submit" name="id" value="{{ $community_form->id }}" class="m-2 btn btn-danger">退会する</button>
       {{-- {{ csrf_field() }} --}}
     </form>
   </div>
  </div>
</div>
@endsection
