@extends('layouts.home')

@section('title.group作成')

@section('content')
<div class="p-4 mx-auto">
  <div class="row m-4">
   <form action="{{ action('User\GroupController@create') }}" method="post" class="col-md-12" enctype="multipart/form-data" >
     @csrf
     @if (count($errors) > 0)
     <ul>
       @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
       @endforeach
     </ul>
     @endif
     <div class="form-group mx-auto row test">
       <table>
         <tbody>
           @foreach((array)$users as $user)
            <tr>
             <td>
               <div class="custom-control custom-checkbox">
                  {{-- <!--<input type="radio" id="customRadio1" name="user_id" class="custom-control-input" value={{$user->id}}>--> --}}
                  {{-- <!--<label class="custom-control-label" for="customRadio1">{{ $user->name}}</label>--> --}}
                  <input class="form-check-input" type="checkbox" value={{$user->id}} name="user_id[]">{{-- データを配列にしてcreate()に飛ばした。--}}
                  <label class="form-check-label" for="customCheck1">
                    {{ $user->name}}
                  </label>
               </div>
             </td>
            </tr>
           @endforeach                    
         </tbody>
       </table>
     </div>
     <div class="float-right pb-6">
        <input type="text" class="m-2" name="name"/ placeholder="会議名を入力">
        <button type="submit" class="m-2 btn btn-primary">会議を作成する</button>
     </div>
   </form>
  </div>
</div>
@endsection