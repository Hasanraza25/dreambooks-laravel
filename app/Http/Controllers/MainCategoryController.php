<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class MainCategoryController extends Controller
{
    public function show($slug){
        $category = category::where('slug', $slug)->first();
        $books = Book::where('category_id', $category->id)->paginate(10);
        $categories = Category::where('status', 'ACTIVE')->get();
        return view('category/detail', compact('books', 'categories'));
    }
}
