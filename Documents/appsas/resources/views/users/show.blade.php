@extends('layouts.app')

@section('content')
<div class="container">
        <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3><br>Manage your profile:</h3>
                    <table class="tabe table-striped", cellpadding="5">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th> </th>
                        </tr>
                        <tr>
                            <td>{{Auth::user()->name}}</td>
                            <td>{{Auth::user()->email}}</td>
                            <td>{{Auth::user()->username}}</td>
                            <td><a href="/profile/{{Auth::user()->id}}/edit" class="btn btn-default">Edit</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
