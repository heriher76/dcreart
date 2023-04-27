<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\DetailPost;
use App\Models\DetailProject;

use DataTables;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string'
        ], [
            'name.required' => 'Nama Kategori tidak boleh kosong !',
            'name.string' => 'Nama Kategori harus berupa karakter !',
        ]);

        if($validate->fails()) {
            $error = $validate->errors()->all();
            return response()->json([
                'message' => $error
            ], 400);
        }

        $store = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if($store){
            return response()->json([
                'message' => 'Data berhasil ditambahkan !',
                'data' => $store
            ], 200);
        }else{
            return response()->json([
                'message' => 'Data gagal ditambahkan !',
                'data' => null
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::find($id);
        return view('pages.admin.category.form', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string'
        ], [
            'name.required' => 'Nama Kategori tidak boleh kosong !',
            'name.string' => 'Nama Kategori harus berupa karakter !',
        ]);

        if($validate->fails()) {
            $error = $validate->errors()->all();
            return response()->json([
                'message' => $error
            ], 400);
        }

        $data = Category::find($id);

        $update = $data->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if($update){
            return response()->json([
                'message' => 'Data berhasil diubah !',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'message' => 'Data gagal diubah !',
                'data' => null
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $data['posts'] = DetailPost::where('category_id', $category->id);
            $data['projects'] = DetailProject::where('category_id', $category->id);

            // return response()->json($data, 500);
            if ($data['posts']->count() > 0) {
                for ($i=0; $i < $data['posts']->count(); $i++) { 
                    $data['posts']->delete();
                }
            }

            if ($data['projects']->count() > 0) {
                for ($a=0; $i < $data['projects']->count(); $a++) { 
                    $data['projects']->delete();
                }
            }

            $category->delete();

            return response()->json([
                'message' => 'Data berhasil dihapus !',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => ['Data gagal dihapus ! ', "[".$e->getMessage()."]"],
                'data' => null
            ], 500);
        }
    }

    /**
     * Data Category
     */

     public function data()
     {
        $categorys = Category::get();

        return DataTables::of($categorys)
                        ->addColumn('created_at', function($row){
                            return $row->created_at->format('d/m/Y H:i:s');
                        })->addColumn('updated_at', function($row){
                            return $row->updated_at->format('d/m/Y H:i:s');
                        })->addColumn('action', function($row){
                            $link['edit'] = route('admin.category.edit', $row->id);
                            $link['destroy'] = route('admin.category.destroy', $row->id);
                            return $link;
                        })->addIndexColumn()->make(true);
     }
}
