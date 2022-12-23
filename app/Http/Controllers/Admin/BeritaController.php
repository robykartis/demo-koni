<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeritaKatModel;
use App\Models\BeritaModel;
use App\Models\BeritaBalasanModel;
use Berita;
use Beritakt;
use Validator;
use Image;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Berita - Admin';

        $data = DB::table('tb_berita')
            ->join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->select('tb_berita.*', 'tb_beritakat.nama as kategoriberita', 'tb_beritakat.id as idkat')
            ->where('tb_berita.aktif', 1)->get();
        // $tgl = Carbon::createFromFormat('Y-m-d H:i:s', $data->tgl_berita)->format('d-m-Y');



        return view('admin.berita')->with([
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
        $title = 'Tambah Data Berita - Admin';
        $data = BeritaKatModel::get();


        return view('admin.beritatbh')->with([
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

            "foto" => $inputdua['imagename'],

        ]);
        return redirect()->route('berita.index')->with('message', 'Data Berhasil Disimpan');
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

            ]);
            return redirect()->route('berita.index')->with('message', 'Data Berhasil Disimpan');
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


            ]);
            return redirect()->route('berita.index')->with('message', 'Data Berhasil Disimpan');
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
        $title = 'Edit Data Berita - Admin';
        $kat = BeritaKatModel::get();
        $data = DB::table('tb_berita')
            ->join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->select('tb_berita.*', 'tb_beritakat.nama as kategoriberita',  'tb_beritakat.id as idkat')
            ->where('tb_berita.id', $id)->first();



        return view('admin.beritaedit')->with([
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
        BeritaModel::find($id)->delete();
        return redirect()->route('berita.index')
            ->with('message', 'Data Berhasil Dihapus');
    }

    //draft berita
    public function draftberita()
    {
        $title = 'Data Draft Berita - Admin';

        $data = DB::table('tb_berita')
            ->join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->join('tb_cabor', 'tb_berita.status', '=', 'tb_cabor.id')
            ->select('tb_berita.*', 'tb_beritakat.nama as kategoriberita', 'tb_beritakat.id as idkat', 'tb_cabor.cabor as cabor')
            ->where('tb_berita.status', '!=', 0)->where('tb_berita.aktif', '!=', 1)->get();
        // $tgl = Carbon::createFromFormat('Y-m-d H:i:s', $data->tgl_berita)->format('d-m-Y');



        return view('admin.draftberita')->with([
            'data' => $data,
            'title' => $title,
        ]);
    }

    public function detaildraftberita($id)
    {
        $title = 'Detail Draft Berita - Admin';


        $kat = BeritaKatModel::get();
        $data = DB::table('tb_berita')
            ->join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->join('tb_cabor', 'tb_berita.status', '=', 'tb_cabor.id')
            ->select('tb_berita.*', 'tb_beritakat.nama as kategoriberita',  'tb_beritakat.id as idkat', 'tb_cabor.cabor as cabor')
            ->where('tb_berita.status', '!=', 0)->where('tb_berita.aktif', '!=', 1)->where('tb_berita.id', $id)->first();

        if ($data == null) {
            return abort(404);
        }

        $ulasan = BeritaBalasanModel::where('id_berita', $id)->orderBy('tgl', 'ASC')->get();

        $cekulas = DB::table('tb_berita_balasan')->select('id', 'id_berita')->where('id_berita', $id)->count();





        return view('admin.draftberitadetail')->with([
            'data' => $data,
            'title' => $title,
            'kat' => $kat,
            'ulasan' => $ulasan,
            'cekulas' => $cekulas,
        ]);
    }

    public function accberita(Request $request)
    {

        $value_to_insert = $request['status_user'] == 'true' ? 1 : 0;

        $id = $request['id'];
        if ($value_to_insert == 1) {
            $user = BeritaModel::findOrFail($id);
            $user->update([
                'aktif' => 1,
            ]);
            return redirect()->to('admin/draftberita')
                ->with('message', 'Berita Berhasil Diverifikasi');
        } else {


            $validator = Validator::make(
                $request->all(),
                [
                    'alasan' => 'required',
                ],
            );
            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $a = $request['alasan'];
            $tgl = Carbon::now();

            $simpan = BeritaBalasanModel::create([

                "balasan" => $a,
                "id_berita" => $id,
                "tgl" => $tgl,
                "editor" => 'Admin',

            ]);
            $user = BeritaModel::findOrFail($id);
            $user->update([
                'aktif' => 2,
            ]);
            return redirect()->to('admin/draftberita')
                ->with('message', 'Berita Berhasil Ditolak');
        }
    }
}
