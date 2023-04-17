@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}
@if($errors->has('username'))
<div class="error">
<p>{{ $errors->first('username') }}</p>
</div>
@endif

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}
@if($errors->has('mail'))
<div class="error">
<p>{{ $errors->first('mail') }}</p>
</div>
@endif

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}
@if($errors->has('password'))
<div class="error">
<p>{{ $errors->first('password') }}</p>
</div>
@endif

{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}
@if($errors->has('password_confirmation'))
<div class="error">
<p>{{ $errors->first('password_confirmation') }}</p>
</div>
@endif
{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
