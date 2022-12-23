<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaborModel;
use App\Models\ClubModel;

use Validator;
use Image;
use DB;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Club - Admin';

        $data = DB::table('tb_club')
            ->join('tb_cabor', 'tb_club.id_cabor', '=', 'tb_cabor.id')
            ->select('tb_club.*', 'tb_cabor.cabor as namacabor', 'tb_cabor.id as idcabor')
            ->get();
        $cabor = CaborModel::select('id', 'cabor')->get();


        return view('admin.club')->with([
            'data' => $data,
            'cabor' => $cabor,
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
        $title = 'Tambah Data Club - Admin';
        $data = CaborModel::get();


        return view('admin.clubtbh')->with([
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
                'club' => 'required',
                'id_cabor' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['club'];
        $b = $request['id_cabor'];
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

        if ($e == null) {
            if ($g == null) {
                $simpan = ClubModel::create([

                    "club" => $a,
                    "id_cabor" => $b,
                    "alamat" => $c,
                    "sk" => $d,

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,




                ]);
                return redirect()->route('club.index')->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/club/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/club');
                $image->move($destinationPath, $input['imagename']);
                $simpan = ClubModel::create([

                    "club" => $a,
                    "id_cabor" => $b,
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

                ]);
                return redirect()->route('club.index')->with('message', 'Data Berhasil Disimpan');
            }
        } else {
            if ($g == null) {
                $simpan = ClubModel::create([

                    "club" => $a,
                    "id_cabor" => $b,
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


                ]);
                return redirect()->route('club.index')->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/club/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/club');
                $image->move($destinationPath, $input['imagename']);
                $simpan = ClubModel::create([

                    "club" => $a,
                    "id_cabor" => $b,
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

                ]);
                return redirect()->route('club.index')->with('message', 'Data Berhasil Disimpan');
            }
        }
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'club' => 'required',
                'id_cabor' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $id = $request['id'];
        $a = $request['club'];
        $b = $request['id_cabor'];
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


        if ($e == null) {
            if ($g == null) {
                $user = ClubModel::findOrFail($id);
                $user->update([
                    "club" => $a,
                    "id_cabor" => $b,
                    "alamat" => $c,
                    "sk" => $d,

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                ]);

                return redirect()->route('club.index')->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/club/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/club');
                $image->move($destinationPath, $input['imagename']);

                $user = ClubModel::findOrFail($id);
                $user->update([
                    "club" => $a,
                    "id_cabor" => $b,
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
                ]);


                return redirect()->route('club.index')->with('message', 'Data Berhasil Disimpan');
            }
        } else {
            if ($g == null) {
                $user = ClubModel::findOrFail($id);
                $user->update([
                    "club" => $a,
                    "id_cabor" => $b,
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
                ]);

                return redirect()->route('club.index')->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/club/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/club');
                $image->move($destinationPath, $input['imagename']);

                $user = ClubModel::findOrFail($id);
                $user->update([
                    "club" => $a,
                    "id_cabor" => $b,
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
                ]);


                return redirect()->route('club.index')->with('message', 'Data Berhasil Disimpan');
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
        $title = 'Detail Data Club - Admin';

        $data = DB::table('tb_club')
            ->join('tb_cabor', 'tb_club.id_cabor', '=', 'tb_cabor.id')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_club.*', 'tb_cabor.cabor as namacabor', 'tb_cabor.id as idcabor', 'indukorganisasi.panjang as indukpan', 'indukorganisasi.pendek as indukpen')
            ->where('tb_club.id', $id)->first();




        $hitungpelatih = DB::table('tb_pelatih')
            ->select('tb_pelatih.*')
            ->where('tb_pelatih.id_club', $data->id)->count();

        $hitungatlet = DB::table('tb_atlit')
            ->select('tb_atlit.*')
            ->where('tb_atlit.id_club', $data->id)->count();




        return view('admin.clubshow')->with([
            'data' => $data,

            'hitungpelatih' => $hitungpelatih,
            'hitungatlet' => $hitungatlet,
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
        $title = 'Edit Data Club - Admin';
        $kat = CaborModel::get();
        $data = DB::table('tb_club')
            ->join('tb_cabor', 'tb_club.id_cabor', '=', 'tb_cabor.id')
            ->select('tb_club.*', 'tb_cabor.cabor as namacabor',  'tb_cabor.id as idkat')
            ->where('tb_club.id', $id)->first();


        return view('admin.clubedit')->with([
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
        ClubModel::find($id)->delete();
        return redirect()->route('club.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
