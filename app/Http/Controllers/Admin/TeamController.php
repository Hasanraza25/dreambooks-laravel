<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Team;
use File;

class TeamController extends Controller
{
     public function index()
   {
        $searchTerm = request()->get('s');
        $teams = Team::orWhere('fullname', 'LIKE', "%$searchTerm%")->latest()->paginate(5);
        return view('admin/team/index')->with(compact('teams'));
   }

   public function create()
   {
        return view('admin/team/create');
   } 

   public function store(Request $request)
    {
        $this->validate(request(), [
            'fullname' => 'required|max:100',
            'designation' => 'required|max:100',
            'telephone' => [
                            'required',
                            'regex:/^\+?[0-9\s\-\(\)]+$/',
                            'max:20', // Adjust the max length as needed
                        ],
            'mobile' => [
                            'required',
                            'regex:/^\+?[0-9\s\-\(\)]+$/',
                            'max:20', // Adjust the max length as needed
                        ],
        ]);

        $fileName = null;

        if(request()->hasFile('team_img'))
        {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }

        Team::create([
            'fullname'=> $request->fullname,
            'designation'=> $request->designation,
            'telephone'=> $request->telephone,
            'mobile'=> $request->mobile,
            'email'=> $request->email,
            'facebook_id'=> $request->facebook_id,
            'twitter_id'=> $request->twitter_id,
            'pinterest_id'=> $request->pinterest_id,
            'profile'=> $request->description,
            'team_img'=> $fileName,
            'status'=> 'DEACTIVE',
        ]);

        return redirect()->to('admin/team');
    }

   public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('admin/team/edit')
            ->with(compact('team'));
    }

    public function update($id, Request $request)
    {
         $this->validate(request(), [
            'fullname' => 'required|max:100',
            'designation' => 'required|max:100',
            'telephone' => [
                            'required',
                            'regex:/^\+?[0-9\s\-\(\)]+$/',
                            'max:20', // Adjust the max length as needed
                        ],

            'mobile' => [
                            'required',
                            'regex:/^\+?[0-9\s\-\(\)]+$/',
                            'max:20', // Adjust the max length as needed
                        ],
        ]);
        $team = Team::findOrFail($id);
        $currentImage = $team->team_img;

        $fileName = null;

        if(request()->hasFile('team_img'))
        {
            $file = request()->file('team_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);
        }
        $team->update([
            'fullname'=> $request->fullname,
            'designation'=> $request->designation,
            'telephone'=> $request->telephone,
            'mobile'=> $request->mobile,
            'email'=> $request->email,
            'facebook_id'=> $request->facebook_id,
            'twitter_id'=> $request->twitter_id,
            'pinterest_id'=> $request->pinterest_id,
            'profile'=> $request->description,
            'team_img'=> ($fileName) ? $fileName : $currentImage,
            'status'=> 'DEACTIVE',
        ]);

        if($fileName){
            File::delete('./uploads/' . $currentImage);
        }

        return redirect()->to('admin/team');
    } 

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $currentImage = $team->team_img;
        $team->delete();
        File::delete('./uploads/'. $currentImage);
        echo 'true';
        // return redirect()->back();
    }
    public function status($id)
    {
        sleep(1);
        $team = Team::findOrFail($id);
        $newStatus = ($team->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $team->update([
            'status' => $newStatus
        ]);

        echo $newStatus;
    }

    public function active_all_status(Request $request){
        $checkAll = $request->get('checkAll');

        foreach ($checkAll as $id) {
            echo Team::where('id', $id)->update([
                'status' => 'ACTIVE'
            ]);
        }
    }

    public function deactive_all_status(Request $request){
        $checkAll = $request->get('checkAll');

        foreach ($checkAll as $id) {
            echo Team::where('id', $id)->update([
                'status' => 'DEACTIVE'
            ]);
        }
    }

    public function delete_all(Request $request){
        $checkAll = $request->get('checkAll');

        foreach ($checkAll as $id) {
            echo Team::where('id', $id)->delete();
        }
    }
}
