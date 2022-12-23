<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaborModel;
use App\Models\ClubModel;
use App\Models\IndukOrganModel;
use App\Models\WasitModel;
use Illuminate\Http\Request;
use Validator;
use Image;
use DB;


class CaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Cabor - Admin';

        $data = DB::table('tb_cabor')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_cabor.*', 'indukorganisasi.panjang as indukp', 'indukorganisasi.pendek as indukpendek')
            ->get();



        return view('admin.cabor')->with([
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
        $title = 'Tambah Data Cabor - Admin';
        $data = IndukOrganModel::get();


        return view('admin.cabortbh')->with([
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
                'cabor' => 'required',
                'id_induk' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['cabor'];
        $b = $request['id_induk'];
        $c = $request['alamat'];
        $d = $request['sk'];
        $e = $request['lat'];
        $f = $request['lng'];
        $g = $request['image'];

        //baru
        $aa = $request['tgl_terbit'];
        $bb = $request['tgl_berakhir'];
        $cc = $request['nama_ketua'];
        $dd = $request['nama_sekretaris'];
        $ee = $request['nama_bendahara'];
        $ff = $request['jml_pengurus'];
        $gg = $request['no_surat_koni'];
        $hh = $request['tgl_surat_koni'];


        if ($e == null) {
            if ($g == null) {
                $simpan = CaborModel::create([

                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,




                ]);
                return redirect()->route('cabor.index')->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/cabor/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/cabor');
                $image->move($destinationPath, $input['imagename']);
                $simpan = CaborModel::create([

                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,

                    "logo" => $input['imagename'],

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,

                ]);
                return redirect()->route('cabor.index')->with('message', 'Data Berhasil Disimpan');
            }
        } else {
            if ($g == null) {
                $simpan = CaborModel::create([

                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,
                    "lat" => $e,
                    "lng" => $f,

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,


                ]);
                return redirect()->route('cabor.index')->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/cabor/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/cabor');
                $image->move($destinationPath, $input['imagename']);
                $simpan = CaborModel::create([

                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,
                    "lat" => $e,
                    "lng" => $f,
                    "logo" => $input['imagename'],

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,

                ]);
                return redirect()->route('cabor.index')->with('message', 'Data Berhasil Disimpan');
            }
        }
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cabor' => 'required',
                'id_induk' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $id = $request['id'];
        $a = $request['cabor'];
        $b = $request['id_induk'];
        $c = $request['alamat'];
        $d = $request['sk'];
        $e = $request['lat'];
        $f = $request['lng'];
        $g = $request['image'];

        //baru
        $aa = $request['tgl_terbit'];
        $bb = $request['tgl_berakhir'];
        $cc = $request['nama_ketua'];
        $dd = $request['nama_sekretaris'];
        $ee = $request['nama_bendahara'];
        $ff = $request['jml_pengurus'];
        $gg = $request['no_surat_koni'];
        $hh = $request['tgl_surat_koni'];



        if ($e == null) {
            if ($g == null) {
                $user = CaborModel::findOrFail($id);
                $user->update([
                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,
                ]);

                return redirect()->route('cabor.index')->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/cabor/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/cabor');
                $image->move($destinationPath, $input['imagename']);

                $user = CaborModel::findOrFail($id);
                $user->update([
                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,

                    "logo" => $input['imagename'],

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,
                ]);


                return redirect()->route('cabor.index')->with('message', 'Data Berhasil Disimpan');
            }
        } else {
            if ($g == null) {
                $user = CaborModel::findOrFail($id);
                $user->update([
                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,
                    "lat" => $e,
                    "lng" => $f,

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,
                ]);

                return redirect()->route('cabor.index')->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/cabor/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/cabor');
                $image->move($destinationPath, $input['imagename']);

                $user = CaborModel::findOrFail($id);
                $user->update([
                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,
                    "lat" => $e,
                    "lng" => $f,
                    "logo" => $input['imagename'],

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,
                ]);


                return redirect()->route('cabor.index')->with('message', 'Data Berhasil Disimpan');
            }
        }
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
        $title = 'Detail Data Cabor - Admin';

        $data = DB::table('tb_cabor')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_cabor.*',  'indukorganisasi.panjang as indukpan', 'indukorganisasi.pendek as indukpen')
            ->where('tb_cabor.id', $id)->first();


        if ($data == null) {
            return abort(404);
        }

        $club = ClubModel::where('id_cabor', $id)->get();
        $wasit = WasitModel::where('id_cabor', $id)->get();

        $hitungclub = DB::table('tb_club')
            ->select('id')
            ->where('tb_club.id_cabor', $id)->count();

        $hitungpelatih = DB::table('tb_pelatih')
            ->select('id')
            ->where('tb_pelatih.id_cabor', $id)->count();

        $hitungatlet = DB::table('tb_atlit')
            ->where('tb_atlit.id_cabor', $id)->select('id')
            ->count();

        $hitungwasit = DB::table('tb_wasit')
            ->where('tb_wasit.id_cabor', $id)->select('id')
            ->count();

        return view('admin.caborshow')->with([
            'data' => $data,
            'club' => $club,
            'wasit' => $wasit,
            'title' => $title,
            'hitungclub' => $hitungclub,
            'hitungpelatih' => $hitungpelatih,
            'hitungatlet' => $hitungatlet,
            'hitungwasit' => $hitungwasit,
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
        $title = 'Edit Data Cabor - Admin';
        $kat = IndukOrganModel::get();
        $data = DB::table('tb_cabor')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_cabor.*', 'indukorganisasi.panjang as indukp', 'indukorganisasi.pendek as indukpendek', 'indukorganisasi.id as idkat')
            ->where('tb_cabor.id', $id)->first();

        if ($data == null) {
            return abort(404);
        }
        return view('admin.caboredit')->with([
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
        CaborModel::find($id)->delete();
        return redirect()->route('cabor.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
