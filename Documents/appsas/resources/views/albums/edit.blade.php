@extends('layouts.app')

@section('content')
    <h1>Edit Album</h1>
    {!! Form::open(['action' => ['AlbumsController@update', $album->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $album->title, ['class' => 'form-control', 'placeholder' => 'e.g. Great Coin'])}}
        <div class="form-group">
            {{Form::label('body', 'About')}}
            {{Form::textarea('body', $album->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'e.g. This coin was found...'])}}
        </div>
        <div class:"form-group">
                {{Form::file('cover_image')}}
            </div>
            <br>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection