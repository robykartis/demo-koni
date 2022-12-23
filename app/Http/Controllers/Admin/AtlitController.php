<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaborModel;
use App\Models\IndukOrganModel;
use App\Models\AtlitModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\ClubModel;
use App\Models\PrestasiModel;
use App\Models\Juara;
use App\Models\Medali;
use Cabor;
use Validator;
use Image;
use DB;
use Carbon\Carbon;

class AtlitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Atlet - Admin';


        $cabor = CaborModel::select('id', 'cabor')->get();

        return view('admin.atlit')->with([

            'cabor' => $cabor,
            'title' => $title,

        ]);
    }

    public function fetchCity(Request $request)
    {
        $data['states'] = KelurahanModel::where("kec_id", $request->kec_id)->get(["kelurahan", "id"]);
        return response()->json($data);
    }
    public function fetchClub(Request $request)
    {
        $data['states'] = ClubModel::where("id_cabor", $request->kec_id)->get(["club", "id"]);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Data Atlet - Admin';
        $data = CaborModel::get();
        $kec = KecamatanModel::get(["kecamatan", "id"]);

        $kejur = Juara::get();
        $medal = Medali::get();

        return view('admin.atlittbh')->with([
            'data' => $data,
            'title' => $title,
            'kec' => $kec,
            'kejur' => $kejur,
            'medal' => $medal,
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
                'nia' => 'required|unique:tb_atlit',
                'id_cabor' => 'required',
                'id_club' => 'required',
                'nik' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'tgl_lahir' => 'required',
                'jk' => 'required',
                'agama' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',


            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $keypres = random_int(10000000, 99999999);

        $editor = auth()->user()->id;
        $nia = $request['nia'];
        //

        $a = $request['id_cabor'];
        $b = $request['id_club'];
        $c = $request['nik'];
        $d = $request['nama'];
        $e = $request['nohp'];
        $f = $request['tgl_lahir'];
        $g = $request['jk'];
        $h = $request['agama'];
        $i = $request['berat_badan'];
        $j = $request['tinggi_badan'];
        $k = $request['ayah'];
        $l = $request['ibu'];
        $m = $request['kecamatan'];
        $n = $request['kelurahan'];
        $o = $request['alamat'];
        $p = $request['image'];


        if ($p == null) {
            $simpan = AtlitModel::create([

                "id_cabor" => $a,
                "id" => $keypres,
                "id_club" => $b,
                "nik" => $c,
                "nama" => $d,
                "nohp" => $e,
                "tgl_lahir" => $f,
                "jk" => $g,
                "agama" => $h,
                "berat_badan" => $i,
                "tinggi_badan" => $j,
                "ayah" => $k,
                "ibu" => $l,
                "kecamatan" => $m,
                "kelurahan" => $n,
                "alamat" => $o,

                //
                "editor" => $editor,
                "nia" => $nia,

            ]);
            $request->validate([
                'addmore.*.kejuaraan' => '',
                'addmore.*.tahun' => '',
                'addmore.*.tempat' => '',
                'addmore.*.medali' => '',
            ]);


            foreach ($request->addmore as $key => $value) {

                if ($value['kejuaraan'] == null and $value['tahun'] == null and $value['tempat'] == null and $value['medali'] == null) {
                } else {
                    PrestasiModel::create(
                        [
                            'id_atlet' => $keypres,
                            'kejuaraan' => $value['kejuaraan'],
                            'tahun' => $value['tahun'],
                            'tempat' => $value['tempat'],
                            'medali' => $value['medali'],

                        ]

                    );
                }
            }
            return redirect()->route('atlit.index')->with('message', 'Data Berhasil Disimpan');
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
            $destinationPath = public_path('berkas/atlet/thumbnail');
            $img = Image::make($image->path());
            $img->resize(500, 600, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/atlet');
            $image->move($destinationPath, $input['imagename']);
            $simpan = AtlitModel::create([

                "id_cabor" => $a,
                "id" => $keypres,
                "id_club" => $b,
                "nik" => $c,
                "nama" => $d,
                "nohp" => $e,
                "tgl_lahir" => $f,
                "jk" => $g,
                "agama" => $h,
                "berat_badan" => $i,
                "tinggi_badan" => $j,
                "ayah" => $k,
                "ibu" => $l,
                "kecamatan" => $m,
                "kelurahan" => $n,
                "alamat" => $o,
                "foto" => $input['imagename'],
                //
                "editor" => $editor,
                "nia" => $nia,

            ]);
            $request->validate([
                'addmore.*.kejuaraan' => '',
                'addmore.*.tahun' => '',
                'addmore.*.tempat' => '',
                'addmore.*.medali' => '',
            ]);


            foreach ($request->addmore as $key => $value) {

                if ($value['kejuaraan'] == null and $value['tahun'] == null and $value['tempat'] == null and $value['medali'] == null) {
                } else {
                    PrestasiModel::create(
                        [
                            'id_atlet' => $keypres,
                            'kejuaraan' => $value['kejuaraan'],
                            'tahun' => $value['tahun'],
                            'tempat' => $value['tempat'],
                            'medali' => $value['medali'],

                        ]

                    );
                }
            }
            return redirect()->route('atlit.index')->with('message', 'Data Berhasil Disimpan');
        }
    }

    public function updatedata(Request $request)
    {
        $id = $request['id'];
        $validator = Validator::make(
            $request->all(),
            [
                'nia' => 'required|unique:tb_atlit,nia,' . $id,
                'id_cabor' => 'required',
                'id_club' => 'required',
                'nik' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'tgl_lahir' => 'required',
                'jk' => 'required',
                'agama' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',


            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }



        $nia = $request['nia'];


        $a = $request['id_cabor'];
        $b = $request['id_club'];
        $c = $request['nik'];
        $d = $request['nama'];
        $e = $request['nohp'];
        $f = $request['tgl_lahir'];
        $g = $request['jk'];
        $h = $request['agama'];
        $i = $request['berat_badan'];
        $j = $request['tinggi_badan'];
        $k = $request['ayah'];
        $l = $request['ibu'];
        $m = $request['kecamatan'];
        $n = $request['kelurahan'];
        $o = $request['alamat'];
        $p = $request['image'];




        if ($p == null) {
            $user = AtlitModel::findOrFail($id);
            $user->update([
                "id_cabor" => $a,
                "id_club" => $b,
                "nik" => $c,
                "nama" => $d,
                "nohp" => $e,
                "tgl_lahir" => $f,
                "jk" => $g,
                "agama" => $h,
                "berat_badan" => $i,
                "tinggi_badan" => $j,
                "ayah" => $k,
                "ibu" => $l,
                "kecamatan" => $m,
                "kelurahan" => $n,
                "alamat" => $o,
                //
                "nia" => $nia,
            ]);


            return redirect()->route('atlit.index')->with('message', 'Data Berhasil Disimpan');
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
            $destinationPath = public_path('berkas/atlet/thumbnail');
            $img = Image::make($image->path());
            $img->resize(500, 600, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/atlet');
            $image->move($destinationPath, $input['imagename']);

            $user = AtlitModel::findOrFail($id);
            $user->update([
                "id_cabor" => $a,
                "id_club" => $b,
                "nik" => $c,
                "nama" => $d,
                "nohp" => $e,
                "tgl_lahir" => $f,
                "jk" => $g,
                "agama" => $h,
                "berat_badan" => $i,
                "tinggi_badan" => $j,
                "ayah" => $k,
                "ibu" => $l,
                "kecamatan" => $m,
                "kelurahan" => $n,
                "alamat" => $o,
                "foto" => $input['imagename'],
                //
                "nia" => $nia,
            ]);


            return redirect()->route('atlit.index')->with('message', 'Data Berhasil Disimpan');
        }
    }

    public function ubahprestasi(Request $request)
    {



        $id = $request['id'];
        $a = $request['kejuaraan'];
        $b = $request['tahun'];
        $c = $request['tempat'];
        $d = $request['medali'];

        $user = PrestasiModel::findOrFail($id);
        $user->update([
            "kejuaraan" => $a,
            "tahun" => $b,
            "tempat" => $c,
            "medali" => $d,



        ]);
        return  redirect()->back()->with('message', 'Data Berhasil Diupdate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail Data Atlit - Admin';

        $data = DB::table('tb_atlit')
            ->join('tb_cabor', 'tb_atlit.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_atlit.id_club', '=', 'tb_club.id')
            ->join('tb_kecamatan', 'tb_atlit.kecamatan', '=', 'tb_kecamatan.id')
            ->join('tb_kelurahan', 'tb_atlit.kelurahan', '=', 'tb_kelurahan.id')
            ->select('tb_atlit.*', 'tb_cabor.cabor as cabor', 'tb_club.club as club', 'tb_kecamatan.kecamatan as camat', 'tb_kelurahan.kelurahan as lurah')
            ->where('tb_atlit.id', $id)->first();

        $prestasi = DB::table('tb_prestasi')
            ->join('tb_atlit', 'tb_prestasi.id_atlet', '=', 'tb_atlit.id')
            ->join('tb_juara', 'tb_prestasi.kejuaraan', '=', 'tb_juara.id')
            ->join('tb_medali', 'tb_prestasi.medali', '=', 'tb_medali.id')
            ->select('tb_prestasi.*', 'tb_juara.nama as kejur', 'tb_medali.medali as medal',)
            ->where('tb_atlit.id', $id)->get();



        $tanggalLahir = $data->tgl_lahir;
        $usia = Carbon::parse($tanggalLahir)->age;
        // dd($usia);



        return view('admin.atlitshow')->with([
            'data' => $data,
            'usia' => $usia,
            'prestasi' => $prestasi,
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
        $title = 'Edit Data Atlit - Admin';
        $kat = CaborModel::get();


        $kec = KecamatanModel::get(["kecamatan", "id"]);

        $kejur = Juara::get();
        $medal = Medali::get();

        $data = DB::table('tb_atlit')
            ->join('tb_cabor', 'tb_atlit.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_atlit.id_club', '=', 'tb_club.id')
            ->join('tb_kecamatan', 'tb_atlit.kecamatan', '=', 'tb_kecamatan.id')
            ->join('tb_kelurahan', 'tb_atlit.kelurahan', '=', 'tb_kelurahan.id')
            ->select('tb_atlit.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcaborkat', 'tb_club.club as club', 'tb_club.id as idclub', 'tb_kecamatan.kecamatan as camat', 'tb_kecamatan.id as idcamat', 'tb_kelurahan.kelurahan as lurah', 'tb_kelurahan.id as idlurah')
            ->where('tb_atlit.id', $id)->first();

        $prestasi = DB::table('tb_prestasi')
            ->join('tb_atlit', 'tb_prestasi.id_atlet', '=', 'tb_atlit.id')
            ->join('tb_juara', 'tb_prestasi.kejuaraan', '=', 'tb_juara.id')
            ->join('tb_medali', 'tb_prestasi.medali', '=', 'tb_medali.id')
            ->select('tb_prestasi.*', 'tb_juara.nama as kejurs', 'tb_juara.id as idkejur', 'tb_medali.medali as medals', 'tb_medali.id as idmedal')
            ->where('tb_atlit.id', $id)
            ->orderBy("tb_prestasi.tahun", "desc")->get();


        return view('admin.atlitedit')->with([
            'data' => $data,
            'kat' => $kat,
            'kec' => $kec,
            'kejur' => $kejur,
            'medal' => $medal,
            'prestasi' => $prestasi,
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
        AtlitModel::find($id)->delete();
        return redirect()->route('atlit.index')
            ->with('message', 'Data Berhasil Dihapus');
    }

    public function preshapus($id)
    {


        PrestasiModel::find($id)->delete();
        return redirect()->back()
            ->with('message', 'Data Berhasil Dihapus');
    }

    public function simpanpres(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kejuaraan' => 'required',
                'tahun' => 'required',
                'medali' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $idat = $request['id_atlet'];
        $a = $request['kejuaraan'];
        $b = $request['tahun'];
        $c = $request['tempat'];
        $d = $request['medali'];

        $simpan = PrestasiModel::create([
            "id_atlet" => $idat,
            "kejuaraan" => $a,
            "tahun" => $b,
            "tempat" => $c,
            "medali" => $d,
        ]);
        return redirect()->back()->with('message', 'Data Berhasil Disimpan');
    }
}
