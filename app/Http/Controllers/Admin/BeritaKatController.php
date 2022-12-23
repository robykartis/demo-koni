<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeritaKatModel;
use Validator;

class BeritaKatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Kategori Berita - Admin';
        $data = BeritaKatModel::get();
        return view('admin.beritakat')->with([
            'data' => $data,
            'title' => $title,
        ]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',


            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['nama'];


        $simpan = BeritaKatModel::create([

            "nama" => $a,

        ]);
        return redirect()->route('beritakat.index')->with('message', 'Data Berhasil Disimpan');
    }


    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',



            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }


        $id = $request['id'];
        $a = $request['nama'];


        $user = BeritaKatModel::findOrFail($id);
        $user->update([
            "nama" => $a,

        ]);
        return  redirect()->route('beritakat.index')->with('message', 'Data Berhasil Diupdate');
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
        $title = 'Edit Data Kategori Berita - Admin';


        $data = BeritaKatModel::where('id', $id)->first();

        return view('admin.beritakatedit')->with([
            'data' => $data,
            'title' => $title,
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
        //fungsi eloquent untuk menghapus data
        BeritaKatModel::find($id)->delete();
        return redirect()->route('beritakat.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
