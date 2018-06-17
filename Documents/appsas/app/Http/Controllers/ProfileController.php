<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::select('SELECT * FROM users WHERE id=users.id');
        return view('users.show')->with('users', $users);
    }

    public function edit($id)
    {
        $user= User::find($id);
        //$users = DB::select('SELECT * FROM users WHERE id=users.id');
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
        ]);
                
                $user = User::find($id);
                $user->id = $request->input('id');
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->username = $request->input('username');
                $user->id = auth()->user()->id;
                $user->save();
        
                return redirect('/profile/'.$id)->with('success', 'Profile Updated');
    }
}
