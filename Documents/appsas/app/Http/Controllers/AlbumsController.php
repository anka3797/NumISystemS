<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Album;
use App\Post;
use App\User;
use DB;
//use Mapper;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class AlbumsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        //$posts = Post:all();
        //$posts = DB::select('SELECT * FROM posts');
        $albums = Album::orderBy('created_at', 'desc')->paginate(10); //fetches all new posts first
        return view('albums.index')->with('albums', $albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        
        // Handle file Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create post
        $album = new Album;
        $album->title = $request->input('title');
        $album->body = $request->input('body');
        $album->user_id = auth()->user()->id;
        $album->cover_image = $fileNameToStore;
        $album->save();

        return redirect('/albums')->with('success', 'Album Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album= Album::with('Posts')->find($id);
        return view('albums.show')->with('album', $album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album= Album::find($id);
        //$user= Auth::user()->username();

        //check for correct user
        if(auth()->user()->id !=$album->user_id && auth()->user()->username != 'admin'){
            return redirect('/albums')->with('error', 'Unauthorized Page');
        }

        return view('albums.edit')->with('album', $album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

               // Handle file Upload
               if($request->hasFile('cover_image')){
                // Get filename with the extension
                $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                // Upload Image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            }
    
    
        //Create post
        $album = Album::find($id);
        $album->title = $request->input('title');
        $album->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $album->cover_image = $fileNameToStore;
        }
        $album->user_id = auth()->user()->id;
        $album->save();

        return redirect('/albums')->with('success', 'Album Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);

        if(auth()->user()->id !=$album->user_id && auth()->user()->username != 'admin'){
            return redirect('/albums')->with('error', 'Unauthorized Page');
        }

        if($album->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/cover_images/'.$album->cover_image);
        }

        $album->delete();
        return redirect('/albums')->with('success', 'Album Deleted');
    }
}
