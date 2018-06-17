@extends('layouts.app')

@section('content')
<div class="container">
        <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Coins</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!--<a href="/coins/create" class="btn btn-primary">Create New Coin</a>
                    <a href="/coins/create" class="btn btn-secondary pull-right">...Add to album</a>-->
                    <h3>Manage your coins:</h3>
                    @if(count($posts) > 0)
                    <table class="tabe table-striped", cellpadding="5">
                        <tr>
                            <th>Name</th>
                            <th> </th>
                            <th> </th>
                            <th> </th>
                        </tr>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>
                                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                            <td><a href="/coins/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
