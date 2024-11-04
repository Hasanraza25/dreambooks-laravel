<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
   {
        $searchTerm = request()->get('s');
        $categories = Category::orWhere('title','LIKE',"%$searchTerm%")->latest()->paginate(5);
        return view('admin/category/index')->with(compact('categories'));
   }

   public function create()
   {
        return view('admin/category/create');
   } 

   public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|max:100',
            'slug' => 'required|max:100',
            'description' => 'required|max:1000'
        ]);

        Category::create([
            'title'=> $request->title,
            'slug'=> Str::slug($request->get('title')),
            'description'=> $request->description,
            'status'=> 'DEACTIVE',
        ]);

        return response()->json(['status' => TRUE, 'msg' => 'Category Created!']);
    }

   public function edit($id)
    {
       
        $category = Category::findOrFail($id);

        return view('admin/category/edit')
            ->with(compact('category'));
    }

    public function update($id, Request $request)
    {
         $this->validate(request(), [
            'title' => 'required|max:100',
            'slug' => 'required|max:100',
            'description' => 'required|max:1000'
        ]);
         
        $category = Category::findOrFail($id);
        $category->update([
            'title'=> $request->title,
            'slug'=> Str::slug($request->get('title')),
            'description'=> $request->description,
        ]);

        return response()->json(['status' => TRUE, 'msg' => 'Category Created!']);
    } 

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        echo 'true';
        // return redirect()->back();
    }
    public function status($id)
    {
        sleep(1);
        $category = Category::findOrFail($id);
        $newStatus = ($category->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $category->update([
            'status' => $newStatus
        ]);

        echo $newStatus;
    }

    public function active_all_status(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Category::where('id', $id)->update([
                'status' => 'ACTIVE'
            ]);
        }
    }

    public function deactive_all_status(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Category::where('id', $id)->update([
                'status' => 'DEACTIVE'
            ]);
        }
    }

    public function delete_all(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Category::where('id', $id)->delete();
        }
    }
}
