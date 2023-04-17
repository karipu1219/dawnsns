@extends('layouts.login')

@section('content')
<div>
<table>
    <tr>
        <td class="icon"><img  class="icon_img" src="/uploads/{{$user->images}}"></td>
        <td>{{ $user->username }}</td>
    </tr>
    <tr>
        <td>{{$user->bio}}</td>
        {!! Form::hidden('id', $user->id) !!}
        @if($followNumbers->contains($user->id))
        <td><a class="btn btn--orange" href="/post/{{ $user->id }}/follow-delete">フォローを外す</a></td>
        @else
        <td><a class="btn btn--orange" href="/post/{{ $user->id }}/follow">フォローする</a></td>
        @endif
    </tr>
</table>
</div>

<div>
@foreach ($follows as $follow)
    @if($follow->posts)
    <tr>
        <td class="icon"><img  class="icon_img" src="/uploads/{{$follow->images}}"></td>
        <td>{{ $follow->username }}</td>
        <td>{{ $follow->posts }}</td>
    </tr>
    @endif
@endforeach
</div>
@endsection