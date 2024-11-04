<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Media;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;


class MainController extends Controller
{
    public function index(){
        $sliders = Media::where(['status' => 'ACTIVE', 'media_type' => 'slider'])->get();
        $upcoming_books = Book::where('status', 'UPCOMING')->limit(5)->get();
        $downloaded_books = Book::with('author', 'category')->orderBy('downloaded', 'DESC')->limit(5)->get();
        $recommended_books = Book::where('recommended', '1')->limit(5)->get();
        $categories = Category::where('status', 'ACTIVE')->get();
        $books = Book::where('status', 'ACTIVE')->paginate(10);
        $author_feature = Author::with('author_books')->where(['status' => 'ACTIVE', 'author_feature' => 'yes'])->inRandomOrder()->first();
        $galleries = Media::where(['status' => 'ACTIVE', 'media_type' => 'image'])->limit(6)->get();
         return view('index', compact('sliders', 'upcoming_books', 'downloaded_books', 'recommended_books', 'categories', 'books', 'author_feature', 'galleries'));
    }

    public function about(){
        $teams = Team::where('status', 'ACTIVE')->limit(5)->get();
        return view('about', compact('teams'));
    }

    public function gallery(){
        $galleries = Media::where(['status' => 'ACTIVE', 'media_type' => 'image'])->paginate(8);
        return view('gallery', compact('galleries'));
    }

    public function author(){
        $searchTerm = request()->get('letter');
        $authors = Author::where('title', 'LIKE', "$searchTerm%")->paginate(10);
        $author_features = Author::where('author_feature', 'yes')->limit(5)->get();
        $downloaded_books = Book::orderBy('downloaded', 'DESC')->limit(5)->get();
        return view('author', compact('authors', 'author_features', 'downloaded_books'));
    }

    public function author_detail($slug){
    $author = Author::where('slug', $slug)->with('author_books')->first();
    return view('author_detail', compact('author'));
}


    public function contact(){
        return view('contact');
    }

     public function contact_index(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Prepare the data for the email
        $mailData = [
            'title' => 'Mail from DreamBooks.com',
            'body' => $validatedData['message'],
            'full_name' => $validatedData['full_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
        ];

        // Send the email
        Mail::to($validatedData['email'])->send(new DemoMail($mailData));

        // Return a response
        return back()->with('success', 'Email is sent successfully.');
    }
}
