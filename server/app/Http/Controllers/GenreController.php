<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function create_genre(Request $request)
    {
        $newGenreData = json_decode($request->getContent());
        $newGenre = new Genre();
        $newGenre->name = $newGenreData->name;
        $newGenre->save();
        return $newGenre;
    }

    public function view_genres(){
        $allGenre = new Genre();
        return $allGenre->all();
    }
}
