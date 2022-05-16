<?php

namespace App\Http\Controllers\Admins\Website;

use Illuminate\Http\Request;
use App\Models\Frontend\Post;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admins\ImageController;
use App\Http\Controllers\Admins\SettingsController;
use App\Http\Requests\Admin\Website\PostEditRequest;
use App\Http\Requests\Admin\Website\PostStoreRequest;

class PostController extends SettingsController
{
    
    public function index()
    {
        $data = [];
        return view('admins.contents.website.post')->with($data);
    }

    public function detail($id = Null)
    {
        if($id !== Null){
            $post = Post::findOrFail($id);
            $data = [
                'post' => $post,
            ];
            return view('admins.contents.website.postDetail')->with($data);
        }
        
        return view('admins.contents.website.postDetail');
    }

    public function recordPost(){
        $post = Post::all();
        $access =  Auth::user();
        return DataTables::of($post)
            ->addIndexColumn()
            ->addColumn('category', function($post){
                return '';
            })
            ->addColumn('action', function($post)  use($access){
                $action = "";
                $title = "'".$post->title."'";
                $action .= '<button id="'. $post->id .'" onclick="editForm('. $post->id .')" class="btn btn-info btn-xs"> Edit</button> ';
                $action .= '<button id="'. $post->id .'" onclick="deleteData('. $post->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button>';
                return $action;
            })
            ->rawColumns(['action'])->make(true);
    }

    public function store(PostStoreRequest $request)
    {
        $data = [
            'title' => $request['title'],
            'subtitle' => $request['subtitle'],
            'slug' => $request['slug'],
            'id_admin' => Auth::user()->id,
            'status' => ($request['draft'] == 'on') ? 1 : 0,
            'body' => ImageController::summernoteImage($request->body, 'Post Image'),
            'image' => $request['futureImage'],
            'meta_description' => $request['meta_desc'],
            'meta_keyword' => $request['meta_keyword'],
        ];
        $activity = Post::create($data);
        if ($activity->exists) {
            return response()
                ->json(['code'=>200,'message' => 'Add new Post Success', 'stat' => 'Success']);
        } else {
            return response()
                ->json(['code'=>200,'message' => 'Error Post Store', 'stat' => 'Error']);
        }
        
    }

    public function update(PostEditRequest $request, $id)
    {
            $data = Post::find($id);
            $data->title            = $request['title'];
            $data->subtitle         = $request['subtitle'];
            $data->slug             = $request['slug'];
            $data->id_admin         = Auth::user()->id;
            $data->status           = ($request['draft'] == 'on') ? 1 : 0;
            $data->body             = ImageController::summernoteImage($request->body, 'Post Image');
            $data->image            = $request['futureImage'];
            $data->meta_description = $request['meta_desc'];
            $data->meta_keyword     = $request['meta_keyword'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Update Post Success', 'stat' => 'Success']);
       
    }
}
