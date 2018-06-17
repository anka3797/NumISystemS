@extends('layouts.app')

@section('content')
    <h1>Create New Coin</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'e.g. Great Coin'])}}
        </div>
        <div class="form-group">
            {{Form::label('years', 'Years')}}
            {{Form::text('years', '', ['class' => 'form-control', 'placeholder' => 'e.g. 1991'])}}
        </div>
        <div class="form-group">
            {{Form::label('country', 'Country')}}
            {{Form::text('country', '', ['class' => 'form-control', 'placeholder' => 'e.g. Lithuania'])}}
        </div>
        <div class="form-group">
            {{Form::label('metal', 'Metal')}}
            {{Form::text('metal', '', ['class' => 'form-control', 'placeholder' => 'e.g. Bronze + Silver'])}}
        </div>
        <div class="form-group">
            {{Form::label('condition', 'Condition')}}
            {{Form::text('condition', '', ['class' => 'form-control', 'placeholder' => 'e.g. BU / Brilliant Uncirculated'])}}
        </div>
        <div class="form-group">
            {{Form::label('rarity', 'Rarity')}}
            {{Form::text('rarity', '', ['class' => 'form-control', 'placeholder' => 'e.g. R from 5-20 (R-7)'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Price')}}
            {{Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'e.g. 25$'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'About')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'e.g. This coin was found...'])}}
        </div>
        <div class:"form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('album_id', $album_id)}}
     
            <br>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
   <!-- <div style="width: 300px; height: 300px;">
            {!! Mapper::render() !!}
        </div>-->
@endsection