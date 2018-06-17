@extends('layouts.app')

@section('content')
<a href="/albums/{{$post->album_id}}" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
        <b>YEARS:</b>
        {{$post->years}}
    </div>
    <div>
        <b>COUNTRY: </b>
        {{$post->country}}
    </div>
    <div>
        <b>METAL: </b>
        {{$post->metal}}
    </div>
    <div>
        <b>CONDITION: </b>
        {{$post->condition}}
    </div>
    <div>
        <b>RARITY: </b>
        {{$post->rarity}}
    </div>
    <div>
        <b>PRICE: </b>
        {{$post->price}}
    </div>
    <br>
    <b>ABOUT:</b>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
</br>
    <small><b>CONTACT ME:</b> {{$post->user->email}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id || Auth::user()->username == 'admin')
        <a href="/coins/{{$post->id}}/edit" class="btn btn-default">Edit</a>
         {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
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