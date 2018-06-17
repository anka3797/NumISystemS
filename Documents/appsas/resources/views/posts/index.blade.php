@extends('layouts.app')

@section('content')
@if(count($posts) > 0)
    <?php
        $colcount = count($posts);
        $i = 0;
    ?>
    <h1>Posts</h3>
            <div id="posts">
            <div class="row text-center">
            @foreach($posts as $post)
            @if($i == $colcount)
                <div class="medium-4 columns end">
                    <img height="250" width="250" src="/storage/cover_images/{{$post->cover_image}}">
                    <h4><a href="/coins/{{$post->id}}">{{$post->title}}</a></h4>
                    <!--<small>written on {{$post->created_at}} by {{$post->user->name}}</small>-->
                </br></br>
            </div>
            @else
            <div class="medium-4 columns end">
                    <img height="250" width="250" src="/storage/cover_images/{{$post->cover_image}}">
                    <h4><a href="/coins/{{$post->id}}">{{$post->title}}</a></h4>
            </br></br>
            </div>
        @endif <?php $i++; ?>
            @endforeach
        </div> 
                <br>
        <!--{{$posts->links()}}-->
    @else
        <p>No posts found</p>
    @endif
@endsection