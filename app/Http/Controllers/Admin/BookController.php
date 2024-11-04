<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Media;
use App\Models\Team;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use File;

class BookController extends Controller
{
    public function index()
   {
        $searchTerm = request()->get('s'); 
        $books = Book::orWhere('title', 'LIKE', "%$searchTerm%")->latest()->paginate(5);
        return view('admin/book/index')->with(compact('books'));
   }

   public function create()
   {    
        $authors = Author::get();
        $categories = Category::get();
        $countries = Country::get();
        return view('admin/book/create', compact('authors','categories', 'countries'));
   } 

   public function store(Request $request)
    {
        $this->validate(request(), [
            'title'=> 'required|max:100',
            // 'slug' => 'required|max:100',
            'slug' => 'required|string|max:100|unique:book,slug', // Replace table_name with your actual table name
            'category_id' => 'required|exists:category,id', // Ensures the category exists
            'author_id' => 'required|exists:author,id', // Ensures the author exists
            'availability' => 'required|max:100', // Ensure the value is valid
            'price' => 'required|numeric|min:0', // Price should be a non-negative number
        ]);

        $fileName = null;

        if(request()->hasFile('book_img'))
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()).time(). "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $bookUpload = null;

        if(request()->hasFile('book_upload'))
        {
            $file = request()->file('book_upload');
            $bookUpload = md5($file->getClientOriginalName()). time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $bookUpload);
        }

        Book::create([
            'title' => $request->title,
            'slug' => Str::slug($request->get('title')),
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'availability'=> $request->availability,
            'price'=> $request->price,
            'rating'=> 0,
            'publisher'=> $request->publisher,
            'country_of_publisher'=> $request->country_of_publisher,
            'isbn'=> $request->isbn,
            'isbn_10'=> $request->isbn_10,
            'audience'=> $request->audience,
            'format'=> $request->format,
            'language'=> $request->language,
            'total_pages'=> $request->total_pages,
            'downloaded'=> $request->downloaded,
            'edition_number'=> $request->edition_number,
            'recommended'=> $request->recommended,
            'description'=> $request->description,
            'book_img'=> $fileName,
            'book_upload'=> $bookUpload,
            'status'=> 'DEACTIVE',
        ]);

        return redirect()->to('/admin/book');
    }

   public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::get();
        $categories = Category::get();
        $countries = Country::get();
        return view('admin/book/edit')
            ->with(compact('book', 'categories', 'authors', 'countries'));
    }

    public function update($id, Request $request)
    {
        $this->validate(request(), [
            'title'=> 'required|max:100',
            'slug' => 'required|max:100',
            'category_id' => 'required|exists:category,id', // Ensures the category exists
            'author_id' => 'required|exists:author,id', // Ensures the author exists
            'availability' => 'required|max:100' , // Ensure the value is valid
            'price' => 'required|numeric|min:0', // Price should be a non-negative number
        ]);

        $book = Book::findOrFail($id);
        $currentImage = $book->book_img;

        $fileName = null;

        if(request()->hasFile('book_img'))
        {
            $file = request()->file('book_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        $currentUpload = $book->book_upload;

        $bookUpload = null;

        if(request()->hasFile('book_upload'))
        {
            $file = request()->file('book_upload');
            $bookUpload = md5($file->getClientOriginalName()). time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $bookUpload);
        }
        $book->update([
            'title' => $request->title,
            'slug' => Str::slug($request->get('title')),
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'availability'=> $request->availability,
            'price'=> $request->price,
            'rating'=> 0,
            'publisher'=> $request->publisher,
            'country_of_publisher'=> $request->country_of_publisher,
            'isbn'=> $request->isbn,
            'isbn_10'=> $request->isbn_10,
            'audience'=> $request->audience,
            'format'=> $request->format,
            'language'=> $request->language,
            'total_pages'=> $request->total_pages,
            'downloaded'=> $request->downloaded,
            'edition_number'=> $request->edition_number,
            'recommended'=> $request->recommended,
            'description'=> $request->description,
            'book_img'=> ($fileName) ? $fileName : $currentImage,
            'book_upload'=> ($bookUpload) ? $bookUpload : $currentUpload,
            'status'=> 'DEACTIVE',
        ]);

        if($fileName){
            File::delete('./uploads/' . $currentImage);
        }

        if($bookUpload){
            File::delete('./uploads/' . $currentUpload);
        }
        return redirect()->to('/admin/book');
    } 

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $currentImage = $book->book_img;
        $currentUpload = $book->book_upload;
        $book->delete();
        File::delete('./uploads/'. $currentImage);
        File::delete('./uploads/'. $currentUpload);
        echo 'true';
        // return redirect()->back();
    }
    public function status($id)
    {
        sleep(1);
        $book = Book::findOrFail($id);
        $newStatus = ($book->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $book->update([
            'status' => $newStatus
        ]);
        
        echo $newStatus;
    }

    public function active_all_status(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Book::where('id', $id)->update([
                'status' => 'ACTIVE'
            ]);
        }
    }

    public function deactive_all_status(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Book::where('id', $id)->update([
                'status' => 'DEACTIVE'
            ]);
        }
    }

    public function delete_all(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Book::where('id', $id)->delete();
        }
    }
}
