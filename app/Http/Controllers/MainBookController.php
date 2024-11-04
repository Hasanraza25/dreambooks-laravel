<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class MainBookController extends Controller
{
    public function show($slug){
        
        $book = Book::where('slug', $slug)->first();
        $relatedBooks = $book->category->books()->where('id', '!=', $book->id)->take(3)->get();
        return view('book/detail', compact('book', 'relatedBooks'));

    }
}
