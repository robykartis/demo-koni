<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KatPengModel;
use Illuminate\Http\Request;
use Validator;


class KatPengController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kategori Pengurus - Admin';
        $data = KatPengModel::get();

        return view('admin.katpeng')->with([
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
        $title = 'Tambah Data Kategori Pengurus - Admin';


        return view('admin.katpengtbh')->with([

            'title' => $title,
        ]);
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
                'nama_kat' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['nama_kat'];
        $b = $request['tupoksi'];

        $simpan = KatPengModel::create([

            "nama_kat" => $a,
            "tupoksi" => $b,
        ]);
        return redirect()->route('katpeng.index')->with('message', 'Data Berhasil Disimpan');
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kat' => 'required',


            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }


        $id = $request['id'];
        $a = $request['nama_kat'];
        $b = $request['tupoksi'];

        $user = KatPengModel::findOrFail($id);
        $user->update([
            "nama_kat" => $a,
            "tupoksi" => $b,
        ]);
        return  redirect()->route('katpeng.index')->with('message', 'Data Berhasil Diupdate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail Data Kategori Pengurus - Admin';


        $data = KatPengModel::where('id', $id)->first();

        return view('admin.katpengshow')->with([
            'data' => $data,
            'title' => $title,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Data Kategori Pengurus - Admin';


        $data = KatPengModel::where('id', $id)->first();

        return view('admin.katpengedit')->with([
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
        KatPengModel::find($id)->delete();
        return redirect()->route('katpeng.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
