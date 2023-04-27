<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;

use DataTables;
use Hash;
use Validator;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.accounts.index');
    }

    public function dataAdmin()
    {
        $admins = Admin::get();

        return DataTables::of($admins)
                        ->addColumn('created_at', function($row){
                            return $row->created_at->format('d/m/Y H:i:s');
                        })->addColumn('updated_at', function($row){
                            return $row->updated_at->format('d/m/Y H:i:s');
                        })->addColumn('action', function($row){
                            $link['edit'] = route('admin.accounts.admin.edit', $row->id);
                            $link['destroy'] = route('admin.accounts.admin.destroy', $row->id);
                            return $link;
                        })->addIndexColumn()->make(true);
    }

    public function createDataAdmin()
    {
        return view('pages.admin.accounts.form');
    }

    public function editDataAdmin($id)
    {
        $data = Admin::find($id);
        return view('pages.admin.accounts.form', [
            'data' => $data
        ]);
    }

    public function storeDataAdmin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'email' => 'required|string|min:6',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Nama tidak boleh kosong !',
            'name.string' => 'Nama harus berupa karakter !',
            'email.required' => 'Email tidak boleh kosong !',
            'email.string' => 'Email harus berupa karakter !',
            'password.required' => 'Password tidak boleh kosong !',
            'password.min' => 'Password minimal 6 karakter !',
        ]);

        if($validate->fails()) {
            $error = $validate->errors()->all();
            return response()->json([
                'message' => $error
            ], 400);
        }

        $store = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
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

    public function updateDataAdmin(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'email' => 'required|string|min:6',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Nama tidak boleh kosong !',
            'name.string' => 'Nama harus berupa karakter !',
            'email.required' => 'Email tidak boleh kosong !',
            'email.string' => 'Email harus berupa karakter !',
            'password.required' => 'Password tidak boleh kosong !',
            'password.min' => 'Password minimal 6 karakter !',
        ]);

        $data = Admin::find($id);

        $update = $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
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

    public function destroyDataAdmin($id)
    {
        $countAdmin = Admin::count();
        
        if ($id == Auth::guard('admin')->user()->id) {
            return response()->json([
                'message' => 'Data anda tidak dapat dihapus !'
            ], 422);
        }

        if ($countAdmin == 1) {
            return response()->json([
                'message' => 'Data terakhir tidak dapat dihapus !'
            ], 422);
        }

        $data = Admin::find($id);
        $delete = $data->delete();
        if ($delete) {
            return response()->json([
                'message' => 'Data berhasil dihapus !',
                'data' => null
            ], 200);
        }else{
            return response()->json([
                'message' => 'Data gagal dihapus !',
                'data' => $data
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
