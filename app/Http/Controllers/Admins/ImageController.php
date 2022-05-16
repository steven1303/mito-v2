<?php

namespace App\Http\Controllers\Admins;

use Image;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{

    public function postImage(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
            $extension = $request->file('file')->getClientOriginalExtension();
            $nameWithoutExt = basename($request->file('file')->getClientOriginalName(), '.'.$request->file('file')->getClientOriginalExtension());
            $filename = str_replace(' ', '-', strtolower($nameWithoutExt) . '-' . date('d-m-Y') . '.'.$extension );
            $request->file('file')->storeAs('public/image/', $filename);
            $imagepath = public_path('storage/image/'. $filename);

            $data = [
                'filename' => $filename,
                'type' => $extension,
                'description' => 'Future Image Upload'
            ];

            $imageData = FileUpload::create($data);

            $img = Image::make($imagepath)
                ->save($imagepath, 70);

            return $filename;
        }
    }

    public static function deletePostImage($filename)
    {
        File::delete('storage/image/'. $filename);
        $imageData = FileUpload::where('filename', $filename)->delete();
        return 'Deleted';
    }

    public static function summernoteImage($request, $desc)
    {
        $content = $request;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach($images as $img){
            $src = $img->getAttribute('src');

            if(preg_match('/data:image/', $src)){
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                // Generating a random filename
                $filename = uniqid();
                $filepath = "storage/image/$filename.$mimetype";
                // @see http://image.intervention.io/api/
                $image = \Intervention\Image\Facades\Image::make($src)
                    // resize if required
                    /* ->resize(300, 200) */
                    ->encode($mimetype, 100)  // encode file to the specified mimetype
                    ->save(public_path($filepath));
                    $imageData = [
                        'filename' => $filename.$mimetype,
                        'type' => 'png',
                        'description' => 'Post Image Upload'
                    ];
                    FileUpload::create($imageData);
                
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } 

       return $dom->saveHTML();
    }
}
