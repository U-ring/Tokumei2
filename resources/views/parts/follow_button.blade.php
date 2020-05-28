@if(Auth::check())

    @if (Auth::id() != $user->id)

        @if (Auth::user()->is_following($user->id))

            {!! Form::open(['route' => ['unfollow', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('解除', ['class' => "button btn btn-danger"]) !!}
            {!! Form::close() !!}



        @else

            {!! Form::open(['route' => ['follow', $user->id]]) !!}
                {!! Form::submit('フォロー', ['class' => "button btn btn-primary"]) !!}
            {!! Form::close() !!}


        @endif

    @endif

@endif
