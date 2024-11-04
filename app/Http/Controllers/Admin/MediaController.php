<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Media;
use File;

class MediaController extends Controller
{
     public function index()
   {
        $searchTerm = request()->get('s');
        $medias = Media::orWhere('title', 'LIKE', "%$searchTerm%")->latest()->paginate(5);
        return view('admin/media/index')->with(compact('medias'));
   }

   public function create()
   {
        // Get distinct media types
        $mediaTypes = Media::select('media_type')->distinct()->get();
        return view('admin.media.create', compact('mediaTypes'));
   } 

   public function store(Request $request)
    {
        $this->validate( request(),[
            'title' => 'required|max:100',
            'slug' => 'required|max:100',
        ]); 

        $fileName = null;

        if(request()->hasFile('media_img'))
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()). time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }
       Media::create([
            'title'=> $request->title,
            'slug'=> Str::slug($request->get('title')),
            'media_type'=> $request->media_type,
            'media_img'=> $fileName,
            'description'=> $request->description,
            'status'=> 'DEACTIVE',
       ]);

       return redirect()->to('admin/media');
    }

   public function edit($id)
    {
        $media = Media::findOrFail($id);
        $mediaTypes = Media::select('media_type')->distinct()->get();
        return view('admin/media/edit')
            ->with(compact('media', 'mediaTypes'));
    }

    public function update($id, Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|max:100',
            'slug' => 'required|max:100',
        ]); 
        $media = Media::findOrFail($id);

        $currentImage = $media->media_img;

        $fileName = null;

        if(request()->hasFile('media_img'))
        {
            $file = request()->file('media_img');
            $fileName = md5($file->getClientOriginalName()). time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }
        $media = Media::findOrFail($id);
        $media->update([
            'title'=> $request->title,
            'slug'=> Str::slug($request->get('title')),
            'media_type'=> $request->media_type,
            'media_img'=> ($fileName)? $fileName : $currentImage,
            'description'=> $request->description,
       ]);

        if($fileName){
            File::delete('/uploads/'. $currentImage);
        }

       return redirect()->to('admin/media');
    } 

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $currentImage = $media->media_img;
        $media->delete();
        File::delete('./uploads/'. $currentImage);
        echo 'true';
        // return redirect()->back();
    }
    public function status($id)
    {
        sleep(1);
        $media = Media::findOrFail($id);
        $newStatus = ($media->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $media->update([
            'status' => $newStatus
        ]);

        echo $newStatus;
    }

    public function active_all_status(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Media::where('id', $id)->update([
                'status' => 'ACTIVE'
            ]);
        }
    }

    public function deactive_all_status(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Media::where('id', $id)->update([
                'status' => 'DEACTIVE'
            ]);
        }
    }

    public function delete_all(Request $request){
        $checkAll = $request->get('checkAll');

        foreach($checkAll as $id){
            echo Media::where('id', $id)->delete();
        }
    }
}
