<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Album;
use DB;
//use Mapper;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class PostsController extends Controller
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
        $posts = Post::orderBy('created_at', 'desc')->paginate(10); //fetches all new posts first
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($album_id)
    {
        return view('posts.create')->with('album_id', $album_id);
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
            'years' => 'required',
            'country' => 'required',
            'metal' => 'required',
            'condition' => 'required',
            'rarity' => 'required',
            'price' => 'required',
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
        $post = new Post;
        $post->album_id = $request->input('album_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->years = $request->input('years');
        $post->country = $request->input('country');
        $post->metal = $request->input('metal');
        $post->condition = $request->input('condition');
        $post->rarity = $request->input('rarity');
        $post->price = $request->input('price');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/albums/'.$request->input('album_id'))->with('success', 'Coin Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);
        //$user= Auth::user()->username();

        //check for correct user
        if(auth()->user()->id !=$post->user_id && auth()->user()->username != 'admin'){
            return redirect('/albums/'.$request->input('album_id'))->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with('post', $post);
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
            'body' => 'required',
            'years' => 'required',
            'country' => 'required',
            'metal' => 'required',
            'condition' => 'required',
            'rarity' => 'required',
            'price' => 'required'
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
        $post = Post::find($id);
        $post->album_id = $request->input('album_id');
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->years = $request->input('years');
        $post->country = $request->input('country');
        $post->metal = $request->input('metal');
        $post->condition = $request->input('condition');
        $post->rarity = $request->input('rarity');
        $post->price = $request->input('price');
        if($request->hasFile('cover_image')){
        $post->cover_image = $fileNameToStore;
        }
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/albums/'.$request->input('album_id'))->with('success', 'Coin Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !=$post->user_id && auth()->user()->username != 'admin'){
            return redirect('/albums/'.$request->input('album_id'))->with('error', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/mycoins')->with('success', 'Coin Deleted');
    }

}
