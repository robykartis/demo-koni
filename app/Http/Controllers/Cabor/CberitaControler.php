<?php

namespace App\Http\Controllers\Cabor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeritaKatModel;
use App\Models\BeritaBalasanModel;
use App\Models\BeritaModel;
use Berita;
use Beritakt;
use Validator;
use Image;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CberitaControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Berita - Cabor';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $data = DB::table('tb_berita')
            ->join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->select('tb_berita.*', 'tb_beritakat.nama as kategoriberita', 'tb_beritakat.id as idkat')
            ->where('tb_berita.status', auth()->user()->id_cabor)->get();



        return view('cabor.berita')->with([
            'data' => $data,
            'detail' => $detail,
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
        $title = 'Tambah Data Berita - Cabor';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $data = BeritaKatModel::get();


        return view('cabor.beritatbh')->with([
            'data' => $data,
            'detail' => $detail,
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
                'judul' => 'required',
                'tgl_berita' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=400,min_height=400',
                'isi' => 'required',
                'id_katberita' => 'required',
            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $status = $request['status'];

        $a = $request['judul'];
        $b = $request['tgl_berita'];
        $c = $request['file'];
        $d = $request['isi'];
        $e = $request['id_katberita'];
        $f = $request['tag'];

        $slugrandom = Str::random(4);
        $slug = Str::slug($a, '-');
        $iduser = auth()->user()->id;
        $hasilslug = "$slug-$slugrandom";


        $file = $request->file('file');
        $inputdua['imagename'] = time() . '.' . $file->extension();
        $destinationPath = public_path('berkas/berita/thumbnail');
        $img = Image::make($file->path());
        $img->resize(800, 520, function ($constraint) {
            // $constraint->aspectRatio();
        })->save($destinationPath . '/' . $inputdua['imagename']);
        $destinationPath = public_path('berkas/berita');
        $file->move($destinationPath, $inputdua['imagename']);

        $simpan = BeritaModel::create([

            "judul" => $a,
            "slug" => $hasilslug,
            "tgl_berita" => $b,
            "isi" => $d,
            "id_katberita" => $e,
            "tag" => $f,
            "id_user" => $iduser,
            "status" => $status,
            "aktif" => 0,

            "foto" => $inputdua['imagename'],

        ]);
        return redirect()->route('cberita.index')->with('message', 'Data Berhasil Disimpan');
    }

    public function updatedata(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required',
                'tgl_berita' => 'required',
                'isi' => 'required',
                'id_katberita' => 'required',
            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }

        $aktif = $request['aktif'];

        $status = $request['status'];

        $id = $request['id'];
        $a = $request['judul'];
        $b = $request['tgl_berita'];
        $c = $request['file'];
        $d = $request['isi'];
        $e = $request['id_katberita'];
        $f = $request['tag'];
        $g = $request['file'];

        $slugrandom = Str::random(4);
        $slug = Str::slug($a, '-');
        $iduser = auth()->user()->id;
        $hasilslug = "$slug-$slugrandom";

        if ($g != null) {
            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:min_width=400,min_height=400',
                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $file = $request->file('file');
            $inputdua['imagename'] = time() . '.' . $file->extension();
            $destinationPath = public_path('berkas/berita/thumbnail');
            $img = Image::make($file->path());
            $img->resize(800, 520, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $inputdua['imagename']);
            $destinationPath = public_path('berkas/berita');
            $file->move($destinationPath, $inputdua['imagename']);


            if ($aktif == 2) {
                $user = BeritaModel::findOrFail($id);
                $user->update([

                    "judul" => $a,
                    "slug" => $hasilslug,
                    "tgl_berita" => $b,
                    "isi" => $d,
                    "id_katberita" => $e,
                    "tag" => $f,
                    "id_user" => $iduser,
                    "foto" => $inputdua['imagename'],
                    "status" => $status,
                    "aktif" => 0,

                ]);
                $tglulas = Carbon::now();

                $simpan = BeritaBalasanModel::create([

                    "balasan" => 'Sudah Diperbaiki',
                    "id_berita" => $id,
                    "tgl" => $tglulas,
                    "editor" => 'Cabor',

                ]);
            } else {
                $user = BeritaModel::findOrFail($id);
                $user->update([

                    "judul" => $a,
                    "slug" => $hasilslug,
                    "tgl_berita" => $b,
                    "isi" => $d,
                    "id_katberita" => $e,
                    "tag" => $f,
                    "id_user" => $iduser,
                    "foto" => $inputdua['imagename'],
                    "status" => $status,

                ]);
            }

            return redirect()->route('cberita.index')->with('message', 'Data Berhasil Disimpan');
        } else {

            if ($aktif == 2) {
                $user = BeritaModel::findOrFail($id);
                $user->update([

                    "judul" => $a,
                    "slug" => $hasilslug,
                    "tgl_berita" => $b,
                    "isi" => $d,
                    "id_katberita" => $e,
                    "tag" => $f,
                    "id_user" => $iduser,
                    "status" => $status,
                    "aktif" => 0,


                ]);
                $tglulas = Carbon::now();

                $simpan = BeritaBalasanModel::create([

                    "balasan" => 'Sudah Diperbaiki',
                    "id_berita" => $id,
                    "tgl" => $tglulas,
                    "editor" => 'Cabor',

                ]);
            } else {
                $user = BeritaModel::findOrFail($id);
                $user->update([

                    "judul" => $a,
                    "slug" => $hasilslug,
                    "tgl_berita" => $b,
                    "isi" => $d,
                    "id_katberita" => $e,
                    "tag" => $f,
                    "id_user" => $iduser,
                    "status" => $status,


                ]);
            }


            return redirect()->route('cberita.index')->with('message', 'Data Berhasil Disimpan');
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
        $title = 'Edit Data Berita - Cabor';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $kat = BeritaKatModel::get();
        $data = DB::table('tb_berita')
            ->join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->join('tb_cabor', 'tb_berita.status', '=', 'tb_cabor.id')
            ->select('tb_berita.*', 'tb_beritakat.nama as kategoriberita',  'tb_beritakat.id as idkat', 'tb_cabor.cabor as cabor')
            ->where('tb_berita.status', auth()->user()->id_cabor)->where('tb_berita.id', $id)->first();

        if ($data == null) {
            return abort(404);
        }

        $ulasan = BeritaBalasanModel::where('id_berita', $id)->orderBy('tgl', 'ASC')->get();

        $cekulas = DB::table('tb_berita_balasan')->select('id', 'id_berita')->where('id_berita', $id)->count();


        return view('cabor.beritaedit')->with([
            'data' => $data,
            'detail' => $detail,
            'kat' => $kat,
            'title' => $title,
            'ulasan' => $ulasan,
            'cekulas' => $cekulas,
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
        BeritaModel::find($id)->delete();
        return redirect()->route('cberita.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
