<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FileCKeditor;
use App\Models\Post;

use Str;
use Carbon\Carbon;
use Storage;
use Validator;

class UploadFileCKEditorController extends Controller
{

    public function index()
    {
        $file = FileCKeditor::get();
        return response()->json($file, 200);
    }

    public function show($id)
    {
        $file = FileCKeditor::find($id);
        $file['post'] = Post::where([
            ['description', 'LIKE', "%".Storage::url($file->path)."%"]
        ])->first();
        return response()->json($file, 200);
    }

    public function upload(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'upload' => 'image'
        ]);

        if($validate->fails()) {
            $error = $validate->messages()->toJson();
            $response = '
            <script>
            alert("Error !")
            </script>
            ';
            // @header('Content-type: text/html; charset=utf-8');
            return $response;

            // return response()->json([
            //     'message' => $error
            // ], 400);
        }
        try {
            if (!empty($request->file('upload'))) {
                $pathBukti = "public/files/ckeditor/";
                $fname = Str::slug(Carbon::now()->format('YmdHis')).".".$request->file('upload')->getClientOriginalExtension();
                $fpath = $request->file('upload')->storeAs($pathBukti, $fname);

                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = Storage::url($fpath); 
                $msg = 'Image uploaded successfully'; 

                FileCKeditor::create([
                    'path' => $fpath
                ]);

                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                
                @header('Content-type: text/html; charset=utf-8'); 
                return $response;
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
