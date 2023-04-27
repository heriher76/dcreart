<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Validator;
use Hash;
use DataTables;
use Storage;
use Str;
use Carbon\Carbon;

use App\Models\Admin;
use App\Models\FileCKEditor;
use App\Models\Post;
use App\Models\Project;
use App\Models\SettingsTampilanHeaderHomepage;
use App\Models\SettingsTampilanKontenAboutu as KontenAboutUs;
use App\Models\SettingsTampilanOurClient as OurClient;

class SettingsController extends Controller
{
    public function index()
    {
        $dataSlides = SettingsTampilanHeaderHomepage::get();
        $aboutUsKonten = KontenAboutUs::first();
        return view('pages.admin.settings.index', [
            'dataSlides' => $dataSlides,
            'aboutUsKonten' => $aboutUsKonten
        ]);
    }

    public function kontenAboutUsStore(Request $request)
    {
        
        $data = KontenAboutUs::first();
        if (empty($data)) {
            $newContent = KontenAboutUs::create([
                'title' => $request->get('title'),
                'content' => $request->get('konten')
            ]);

            if ($newContent) {
                return response()->json([
                    'message' => 'Data berhasil disimpan !',
                    'data' => $data
                ], 200);
            }

            return response()->json([
                'message' => 'Data gagal disimpan !',
                'data' => $data
            ], 500);
        }
        
        $updateContent = $data->update([
            'title' => $request->title,
            'content' => $request->konten
        ]);

        if ($updateContent) {
            return response()->json([
                'message' => 'Data berhasil disimpan !',
                'data' => $data
            ], 200);
        }

        return response()->json([
            'message' => 'Data gagal disimpan !',
            'data' => $data
        ], 500);
    }

    public function addSlide()
    {
        try {
           $create = SettingsTampilanHeaderHomepage::create();
            if ($create) {
                return response()->json([
                    'message' => 'Success'
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Error'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    public function saveSlide(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'imgSlide' => 'required|image'
        ], [
            'title.required' => 'Judul tidak boleh kosong !',
            'imgSlide.required' => 'Gambar tidak boleh kosong !',
            'imgSlide.image' => 'Unggahan Harus berupa gambar !'
        ]);

        if($validate->fails()) {
            $error = $validate->messages()->toJson();
            return response()->json([
                'message' => $error
            ], 400);
        }

        $dataSlide = SettingsTampilanHeaderHomepage::find($id);
        if ($dataSlide->path != null) {
            Storage::delete($dataSlide->path);
        }

        if (!empty($request->file('imgSlide'))) {

            $path = "public/files/settings/tampilan/slides";
            $fname = Str::slug(Carbon::now()->format('Ymds-').$request->title).".".$request->file('imgSlide')->getClientOriginalExtension();
            $fpath = $request->file('imgSlide')->storeAs($path, $fname);
        }

        $update = $dataSlide->update([
            'title' => $request->title,
            'path' => $fpath
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Success'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Error'
            ], 500);
        }

    }

    public function deleteSlide($id)
    {
        try {
            $dataSlide = SettingsTampilanHeaderHomepage::find($id);

            if ($dataSlide->path != null) {
                Storage::delete($dataSlide->path);
            }

            $delete = $dataSlide->delete();

            if ($delete) {
                return response()->json([
                    'message' => 'Success'
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Error'
                ], 500);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateDataAccount(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required'
        ]);

        if($validate->fails()) {
            $error = $validate->messages()->toJson();
            return response()->json([
                'message' => $error
            ], 400);
        }

        $account = Auth::guard('admin')->user();

        $emailSamaDenganInput = ($account->email == $request->email);

        if($emailSamaDenganInput){
            $update = $account->update([
                'name' => $request->name
            ]);
        }else{

            $checkAvailableEmail = Admin::where('email', $request->email)->first();

            if ($checkAvailableEmail) {
                return response()->json([
                    'message' => 'Email Sudah tersedia !'
                ], 400);
            }

            $update = $account->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }

        if ($update) {
            return response()->json([
                'message' => "Data berhasil diubah !",
                'account' => Auth::guard('admin')->user()
            ], 200);
        }else{
            return response()->json([
                'message' => $error
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {

        
        if(!Hash::check($request->old_password, Auth::guard('admin')->user()->password)){
            return response()->json([
                'message' => "Password Lama salah !"
            ], 400);
        }

        $validate = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        if($validate->fails()) {
            $error = $validate->messages()->toJson();
            return response()->json([
                'message' => $error
            ], 400);
        }

        $updatePassword = Auth::guard('admin')->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        if ($updatePassword) {
            return response()->json([
                'message' => "Password berhasil diubah !"
            ], 200);
        }else{
            return response()->json([
                'message' => "Password gagal diubah !"
            ], 500);
        }

    }

    public function library()
    {
        $fileCKEditor = FileCKEditor::orderBy('created_at', 'DESC')->get();
        return DataTables::of($fileCKEditor)->addColumn('path', function($row)
        {
            return Storage::url($row->path);
        })->addColumn('content', function($row)
        {
            $searchFileAtPost = Post::where([
                ['description', 'LIKE', '%'.Storage::url($row->path).'%']
            ])->first();

            $searchFileAtProject = Project::where([
                ['description', 'LIKE', '%'.Storage::url($row->path).'%']
            ])->first();

            $searchFileAtKontenAboutUs = KontenAboutUs::where([
                ['content', 'LIKE', '%'.Storage::url($row->path).'%']
            ])->first();
            
            $searchFileAtProject = Project::where([
                ['description', 'LIKE', '%'.Storage::url($row->path).'%']
            ])->first();

            if(!empty($searchFileAtPost)){

                $content['title'] = $searchFileAtPost['title'];
                $content['link_show'] = route('guest.post.detail', $searchFileAtPost['slug']);
                $content['type'] = ucfirst('post');
                $content['published_at'] = $searchFileAtPost['published_at'];
                
            }elseif(!empty($searchFileAtProject)){
                
                $content['title'] = $searchFileAtProject['title'];
                $content['link_show'] = route('guest.project.detail', $searchFileAtProject['slug']);
                $content['type'] = ucfirst('project');
                $content['published_at'] = $searchFileAtProject['published_at'];

            }elseif(!empty($searchFileAtKontenAboutUs)){
                
                $content['title'] = $searchFileAtKontenAboutUs['title'];
                $content['link_show'] = route('admin.settings.index')."#formStoreContentAboutUs";
                $content['type'] = ucfirst('konten (About Us)');
                $content['published_at'] = $searchFileAtKontenAboutUs['created_at'];

            }else{
                $content = null;
            }

            return $content;

        })->addColumn('created_at', function($row)
        {
            return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
        })->addColumn('action', function($row)
        {
            $action['link_delete'] = route('admin.settings.library.deleteFileAtContent', $row->id);

            return $action;
        })->addIndexColumn()->make(true);
    }

    public function deleteFileAtContent($id)
    {
        $file = FileCKEditor::find($id);
        $deleteFile = Storage::delete($file->path);

        if ($deleteFile) {
            $deleteData = $file->delete();

            if ($deleteData) {
                return response()->json([
                    'message' => 'Success Delete Data !'
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Failed Delete Data !'
                ], 500);
            }
        }else{
            return response()->json([
                'message' => 'Failed Delete File !'
            ], 500);
        }
    }

    public function deleteAllChecked(Request $request)
    {
        dd($request->all());
    }

    public function ourClientsData()
    {
        $data = OurClient::get();

        return DataTables::of($data)->addColumn('path', function($row){
            return Storage::url($row->path);
        })->addColumn('action', function ($row)
        {
            $action['show'] = route('admin.settings.tampilan.ourClients.show', $row->id);
            $action['update'] = route('admin.settings.tampilan.ourClients.update', $row->id);
            $action['destroy'] = route('admin.settings.tampilan.ourClients.destroy', $row->id);

            return $action;

        })->addColumn('created_at', function($row)
        {
            return Carbon::parse($row->created_at)->format('d/m/Y H:i:s');
        })->addIndexColumn()->make(true);
    }

    public function ourClientsDatashow($id)
    {
        $data = OurClient::find($id);

        return response()->json($data, 200);
    }

    

    public function ourClientsDataStore(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'nama_client' => 'required|string',
            'imgClient' => 'required|image'
        ], [
            'nama_client.required' => 'Client tidak boleh kosong !',
            'imgClient.required' => 'Gambar tidak boleh kosong !',
            'imgClient.image' => 'Unggahan Harus berupa gambar !'
        ]);

        if($validate->fails()) {
            $error = $validate->messages()->toJson();
            return response()->json([
                'message' => $error
            ], 400);
        }

        if (!empty($request->file('imgClient'))) {

            $path = "public/files/settings/tampilan/our_clients";
            $fname = Str::slug(Carbon::now()->format('Ymds-').$request->title).".".$request->file('imgClient')->getClientOriginalExtension();
            $fpath = $request->file('imgClient')->storeAs($path, $fname);
        }

        $data = OurClient::create([
            'title' => $request->nama_client,
            'path' => $fpath
        ]);

        if ($data) {
            return response()->json([
                'message' => 'Data berhasil disimpan !',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'message' => 'Data gagal disimpan !',
                'data' => $data
            ], 500);
        }
    }

    public function ourClientsDataUpdate(Request $request, $id)
    {
        $data = OurClient::find($id);
        $inputPath = $data->path;

        if (!empty($request->file('imgClient'))) {

            if ($data->path != null) {
                Storage::delete($data->path);
            }

            $path = "public/files/settings/tampilan/our_clients";
            $fname = Str::slug(Carbon::now()->format('Ymds-').$request->title).".".$request->file('imgClient')->getClientOriginalExtension();
            $fpath = $request->file('imgClient')->storeAs($path, $fname);
            $inputPath = $fpath;
        }

        $data = $data->update([
            'title' => $request->nama_client,
            'path' => $inputPath
        ]);

        if ($data) {
            return response()->json([
                'message' => 'Data berhasil diubah !',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'message' => 'Data gagal diubah !',
                'data' => $data
            ], 500);
        }
    }

    public function ourClientsDataDestroy($id)
    {
        $data = OurClient::find($id);

        $delFile = Storage::delete($data->path);

        if ($delFile) {
            $delete = $data->delete();
            if ($delete) {
                return response()->json([
                    'message' => 'Data berhasil dihapus !'
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Data gagal dihapus !'
        ], 500);

        

    }

}
