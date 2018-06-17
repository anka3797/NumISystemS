@extends('layouts.app')

@section('content')
    <h1>Albums</h3>
        @if(count($albums) > 0)
            @foreach($albums as $album)
                <div class="card card-body bg-light">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                        <img style="width:50%" src="/storage/cover_images/{{$album->cover_image}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                                <h3><a href="/albums/{{$album->id}}">{{$album->title}}</a></h3>
                                <small>written on {{$album->created_at}} by {{$album->user->name}}</small>
                            </div>
                    </div>
                </div>
                <br>
            @endforeach
            {{$albums->links()}}
        @else
                <p>No Albums found</p>
        @endif
@endsection