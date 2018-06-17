@extends('layouts.app')

@section('content')
    <h1>Create New Album</h1>
    {!! Form::open(['action' => 'AlbumsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'e.g. Album name'])}}
        <div class="form-group">
            {{Form::label('body', 'About')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'e.g. Short descrription of the album'])}}
        </div>
        <div class:"form-group">
            {{Form::file('cover_image')}}
        </div>
            <br>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection