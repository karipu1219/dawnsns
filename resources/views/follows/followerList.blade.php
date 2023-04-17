@extends('layouts.login')

@section('content')
<div id="clear">
<h>フォロワーリスト</h>

    @foreach ($follower->unique('uid') as $followers)
    <tr>
    {!! Form::hidden('id', $followers->uid) !!}
    <td class="icon"><a href="/{{ $followers->uid }}/profile"><img class="icon_img" src="/uploads/{{$followers->images}}"></a></td>
    </tr>
    @endforeach
</div>

<div id="clear">

<table class='table table-hover'>
@foreach ($follower as $followers)
    @if($followers->posts)
    <tr>
        <td class="icon"><img  class="icon_img" src="/uploads/{{$followers->images}}"></td>
        <td>{{ $followers->username }}</td>
        <td>{{ $followers->posts }}</td>
    </tr>
    @endif
@endforeach
</table>
</div>
@endsection