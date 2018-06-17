<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
class MapController extends Controller
{
    public function index()
    {
        //$posts = Post:all();
        //$posts = DB::select('SELECT * FROM posts');
        Mapper::map(53.381128999999990000, -1.470085000000040000, 
        [
            'zoom' => 16,
            'draggable' => true,
            'marker' => true,
            'eventAfterLoad' =>
            'circleListener(maps[0].shapes[0].circle_0);'
        ]
        );
        return view('index');
    }

}
