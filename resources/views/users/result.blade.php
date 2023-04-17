@extends('layouts.login')

@section('content')
<h></h>
<div id="clear">
<div style="width:50%; margin: 0 auto; text-align:left;">
{!! Form::open(['url' => 'search/index']) !!}
        <div class="form-group">
            {!! Form::input('text', 'keyword', null, ['required', 'class' => 'form-control', 'placeholder' => 'ID名']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right"><img class="icon_img" src="{{ asset('images/search.png') }}"></button>
{!! Form::close() !!}
</div>
<h>検索ワード:{{$keyword}}</h>
<table>
@foreach ($username as $usernames)
    <tr>
        <td>{{ $usernames->username }}</td>
        {!! Form::hidden('id', $usernames->id) !!}
        @if($followNumbers->contains($usernames->id))
        <td><a class="btn btn--orange" href="/post/{{ $usernames->id }}/follow-delete">フォローを外す</a></td>
        @else
        <td><a class="btn btn--orange" href="/post/{{ $usernames->id }}/follow">フォローする</a></td>
        @endif
    </tr>
    @endforeach
    </table>
</div>

@endsection