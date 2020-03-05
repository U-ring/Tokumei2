@extends('layouts.talk')


{{-- talk.blade.php(layouts)の@yield('title')に'匿名トーク'を埋め込む --}}
@section('title', 'テストメッセージ')

@section('nameOf')
  <p class="h3 mx-auto">{{ $group->name }}</p>
@endsection

@section('message')
<div class="container">
  <div id="message-data">
    
  </div>
</div>
<script src="{{ asset('js/message.js') }}"></script>
@endsection