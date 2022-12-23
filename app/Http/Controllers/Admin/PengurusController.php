<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KatPengModel;
use App\Models\PengurusModel;
use Illuminate\Http\Request;
use Validator;
use DB;
use Image;


class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Pengurus - Admin';

        $data = DB::table('tb_pengurus')
            ->join('tb_kat_pengurus', 'tb_pengurus.id_kat_peng', '=', 'tb_kat_pengurus.id')
            ->select('tb_pengurus.*', 'tb_kat_pengurus.nama_kat as jenispengurus',)
            ->get();



        return view('admin.pengurus')->with([
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
        $title = 'Tambah Data Pengurus - Admin';
        $data = KatPengModel::get();

        return view('admin.pengurustbh')->with([
            'data' => $data,
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
                'nama' => 'required',
                'id_kat_peng' => 'required',
                'jk' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['nama'];
        $b = $request['id_kat_peng'];
        $c = $request['jabatan'];
        $d = $request['nohp'];
        $e = $request['jk'];
        $f = $request['image'];

        if ($f == null) {
            $simpan = PengurusModel::create([

                "nama" => $a,
                "id_kat_peng" => $b,
                "jabatan" => $c,
                "nohp" => $d,
                "jk" => $e,

            ]);
            return redirect()->route('pengurus.index')->with('message', 'Data Berhasil Disimpan');
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $image = $request->file('image');
            $input['imagename'] = time() . '.' . $image->extension();
            $destinationPath = public_path('berkas/pengurus/thumbnail');
            $img = Image::make($image->path());
            $img->resize(500, 500, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/pengurus');
            $image->move($destinationPath, $input['imagename']);
            $simpan = PengurusModel::create([

                "nama" => $a,
                "id_kat_peng" => $b,
                "jabatan" => $c,
                "nohp" => $d,
                "jk" => $e,
                "foto" => $input['imagename'],

            ]);
            return redirect()->route('pengurus.index')->with('message', 'Data Berhasil Disimpan');
        }
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'id_kat_peng' => 'required',
                'jk' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }


        $id = $request['id'];
        $a = $request['nama'];
        $b = $request['id_kat_peng'];
        $c = $request['jabatan'];
        $d = $request['nohp'];
        $e = $request['jk'];
        $f = $request['image'];

        if ($f == null) {
            $user = PengurusModel::findOrFail($id);
            $user->update([
                "nama" => $a,
                "id_kat_peng" => $b,
                "jabatan" => $c,
                "nohp" => $d,
                "jk" => $e,
            ]);
            return  redirect()->route('pengurus.index')->with('message', 'Data Berhasil Diupdate');
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $image = $request->file('image');
            $input['imagename'] = time() . '.' . $image->extension();
            $destinationPath = public_path('berkas/pengurus/thumbnail');
            $img = Image::make($image->path());
            $img->resize(500, 600, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/pengurus');
            $image->move($destinationPath, $input['imagename']);

            $user = PengurusModel::findOrFail($id);
            $user->update([
                "nama" => $a,
                "id_kat_peng" => $b,
                "jabatan" => $c,
                "nohp" => $d,
                "jk" => $e,
                "foto" => $input['imagename'],
            ]);
            return  redirect()->route('pengurus.index')->with('message', 'Data Berhasil Diupdate');
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
        $title = 'Edit Data Pengurus - Admin';
        $kat = KatPengModel::get();

        $data = DB::table('tb_pengurus')
            ->join('tb_kat_pengurus', 'tb_pengurus.id_kat_peng', '=', 'tb_kat_pengurus.id')
            ->select('tb_pengurus.*', 'tb_kat_pengurus.nama_kat as jenispengurus', 'tb_kat_pengurus.id as idkat')
            ->where('tb_pengurus.id', $id)->first();
        // $data = PengurusModel::where('id', $id)->first();

        return view('admin.pengurusedit')->with([
            'data' => $data,
            'kat' => $kat,
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
        PengurusModel::find($id)->delete();
        return redirect()->route('pengurus.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
