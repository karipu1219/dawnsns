@extends('layouts.login')

@section('content')
<h2>つぶやき投稿</h2>
<div style="width:50%; margin: 0 auto; text-align:left;">
<h2 class='page-header'>新しく投稿をする</h2>
        {!! Form::open(['url' => 'post/create']) !!}
        <div class="form-group">
            {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
        </div>
        <button type="submit" class="btn btn-success pull-right">投稿</button>
        {!! Form::close() !!}
        
<table class='table table-hover'>
    <tr>
        <th>投稿者</th>
        <th>投稿内容</th>
    </tr>
    @foreach ($posts as $post)
    <tr>
        <td>{{ $post->username }}</td>
        <td>{{ $post->posts }}</td>
        @if($post->uid == Auth::id())
        <td>
    <div class="life-type">
     <a href="" class="modalopen" data-target="{{ $post->pid}}">
      <img  src="{{ asset('images/edit.png') }}" alt="編集">
     </a>
    </div>
    <div class="modal-main js-modal" id="{{ $post->pid}}"> 
    <div class="modal-inner"> 
     <div class="inner-content">
        <form action="/post/{{ $post->pid }}/update-form" method="post">
            @csrf
            <input type="text" name="updatePost" value="{{ $post->posts }}" required class="form-control">
            <input type="image" src="{{ asset('images/edit.png')}}">
        </form>

      <a class="send-button modalClose">Close</a>
     </div>
    </div>
    </div>
        </td>
        <td>
        {!! Form::hidden('id', $post->pid) !!}
            <a class="btn btn-danger" href="/post/{{ $post->pid }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
            <img src="{{ asset('images/trash.png') }}">
            <img src="{{ asset('images/trash_h.png') }}">
            </a>
        </td>
        @endif
        <td>{{$post->created_at}}</td>
    </tr>
    @endforeach
</table>
</div>
@endsection