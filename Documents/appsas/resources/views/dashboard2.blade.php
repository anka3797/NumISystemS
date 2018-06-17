@extends('layouts.app')

@section('content')
<div class="container">
        <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Albums</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/albums/create" class="btn btn-primary">Create New Album</a>
                    <h3><br>Manage your albums:</h3>
                    @if(count($albums) > 0)
                    <table class="tabe table-striped", cellpadding="5">
                        <tr>
                            <th>Name</th>
                            <th></th>
                            <th> </th>
                            <th> </th>
                        </tr>
                        @foreach($albums as $album)
                        <tr>
                            <td>{{$album->title}}</td>
                            <td>
                                {!!Form::open(['action' => ['AlbumsController@destroy', $album->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            </td>
                            <td><a href="/albums/{{$album->id}}/edit" class="btn btn-default">Edit</a></td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no albums</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
