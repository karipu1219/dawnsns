@extends('layouts.login')

@section('content')
<p>{{Auth::user()->username}}さん<img class="icon_img" src="/uploads/{{Auth::user()->images}}"></p>


{!! Form::open(['url' => 'profile/form','enctype'=>'multipart/form-data']) !!}
{!! Form::hidden('id', Auth::user()->id) !!}

{{ Form::label('ユーザー名') }}
{{ Form::text('username',Auth::user()->username,['class' => 'input']) }}
@if($errors->has('username'))
<div class="error">
<p>{{ $errors->first('username') }}</p>
</div>
@endif

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',Auth::user()->mail,['class' => 'input']) }}
@if($errors->has('mail'))
<div class="error">
<p>{{ $errors->first('mail') }}</p>
</div>
@endif

<p>{{ Form::input('password', 'password', Auth::user()->password,['class' => 'input']) }}</p>

{{ Form::label('new Password') }}
{{ Form::password('password',['class' => 'input']) }}
@if($errors->has('password'))
<div class="error">
<p>{{ $errors->first('password') }}</p>
</div>
@endif

{{ Form::label('Bio') }}
{{ Form::text('bio',Auth::user()->bio,['class' => 'input']) }}

{{Form::label('Icon Images') }}
{!! Form::file('file_name') !!}
@if($errors->has('file_name'))
<div class="error">
<p>{{ $errors->first('file_name') }}</p>
</div>
@endif

{{ Form::submit('更新') }}

{!! Form::close() !!}

@endsection