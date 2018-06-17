@extends('layouts.app')

@section('content')
<h1>{{$album->title}}</h1>
<a href="/albums" class="btn btn-secondary">Go Back</a>
@if(!Auth::guest())
    @if(Auth::user()->id == $album->user_id || Auth::user()->username == 'admin')
<a href="/albums/create/{{$album->id}}" class="btn btn-primary">Upload a new coin</a>
    @endif
    @endif
</br></br>

    <b>ABOUT THIS ALBUM:</b>
    <div>
        {!!$album->body!!}
    </div>

    @if(count($album->posts) > 0)
    <?php
        $colcount = count($album->posts);
        $i = 0;
    ?>
    </br>
            <div id="posts">
            <div class="row text-center">
            @foreach($album->posts as $post)
            @if($i == $colcount)
                <div class="medium-4 columns end">
                    <img height="250" width="250" src="/storage/cover_images/{{$post->cover_image}}">
                    <h4><a href="/coins/{{$post->id}}">{{$post->title}}</a></h4>
                    <small>written on {{$post->created_at}}</small>
                </br></br>
            </div>
            @else
            <div class="medium-4 columns end">
                    <img height="250" width="250" src="/storage/cover_images/{{$post->cover_image}}">
                    <h4><a href="/coins/{{$post->id}}">{{$post->title}}</a></h4>
                    <small>written on {{$post->created_at}}</small>
            </br></br>
            </div>
        @endif <?php $i++; ?>
            @endforeach
        </div> 
                <br>
     
    @else
        <p>No posts found</p>
    @endif

    <hr>
    <small>Written on {{$album->created_at}} by {{$album->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $album->user_id || Auth::user()->username == 'admin')
        <a href="/albums/{{$album->id}}/edit" class="btn btn-default">Edit</a>
         {!!Form::open(['action' => ['AlbumsController@destroy', $album->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
         {{Form::hidden('_method', 'DELETE')}}
         {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
         {!!Form::close()!!}
    @endif
    <br>
        @if(Auth::user()->username == 'admin')
        <div class="form-group">
                {{Form::text('comment', '', ['class' => 'form-control', 'placeholder' => 'Comment'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        @endif
    @endif

@endsection