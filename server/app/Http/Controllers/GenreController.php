<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function view_genres(){
        $allGenre = new Genre();
        return $allGenre->all();
    }
}
