@extends('layouts.login')

@section('content')
<div id="clear">
<h>フォローリスト</h>
    @foreach ($follow->unique('uid') as $follows)
    <tr>
    {!! Form::hidden('id', $follows->uid) !!}
    <td class="icon"><a href="/{{ $follows->uid }}/profile"><img class="icon_img" src="/uploads/{{$follows->images}}"></a></td>
    </tr>
    @endforeach
</div>
<div id="clear">
<table class='table table-hover'>
@foreach ($follow as $follows)
    @if($follows->posts)
    <tr>
        <td><img class="icon_img" src="/uploads/{{$follows->images}}"></td>
        <td>{{ $follows->username }}</td>
        <td>{{ $follows->posts }}</td>
    </tr>
    @endif
@endforeach
</table>
</div>
@endsection