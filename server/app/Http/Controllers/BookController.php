<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create_book(Request $request)
    {
        $newBookData = json_decode($request->getContent());

        $newBook = new Book();
        $newBook->title = $newBookData->title;
        $newBook->author = $newBookData->author;
        $newBook->isbn = $newBookData->isbn;
        $newBook->rating = $newBookData->rating;
        $newBook->cover = $newBookData->cover;
        $newBook->genre_id = $newBookData->genre_id;

        $newBook->save();
        return $newBook;
    }

    public function view_books()
    {
        $allBook = new Book();
        return $allBook->all();
    }

    public function book_detail($id)
    {
        return Book::where("id", $id)->first();
    }
}
