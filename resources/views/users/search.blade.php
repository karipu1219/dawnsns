@extends('layouts.login')

@section('content')
<p>ユーザー検索</p>
<div style="width:50%; margin: 0 auto; text-align:left;">
        {!! Form::open(['url' => 'search/index']) !!}
        <div class="form-group">
            {!! Form::input('text', 'keyword', null, ['required', 'class' => 'form-control', 'placeholder' => 'ID名']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right"><img class="icon_img" src="{{ asset('images/search.png') }}"></button>
        {!! Form::close() !!}
</div>

@endsection