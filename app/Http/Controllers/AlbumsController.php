<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    public function index(){

        $albums = Album::all();


        return view('albums.index',compact('albums'));
    }

    public function store(){

        $validated = request()->validate([
            'title' => ['required','min:3','max:255'],
            'artist' => ['required','min:3','max:255']
        ]);

        Album::create($validated);

        /*
        $album = new Album();

        $album->artist = request('artist');
        $album->title = request('title');

        $album->save();

        */

        return redirect('/albums');
    }

    public function show(Album $album){

        return view('albums.show',['album'=>$album]);
    }

    public function edit(Album $album){

        //$album = Album::findOrFail($id);

        return view('albums.edit',['album'=>$album]);
    }

    public function update(Album $album){

        $validated = request()->validate([
            'title' => ['required','min:3','max:255'],
            'artist' => ['required','min:3','max:255']
        ]);

        $album->update($validated);

        return redirect('/albums');
    }
    public function destroy(Album $album){

        $album->delete();

        return redirect('/albums');
    }
}
