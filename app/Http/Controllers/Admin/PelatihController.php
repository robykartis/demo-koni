<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaborModel;
use App\Models\ClubModel;
use App\Models\PelatihModel;
use Validator;
use DB;
use Image;
use Carbon\Carbon;

class PelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Pelatih - Admin';


        $cabor = CaborModel::select('id', 'cabor')->get();

        return view('admin.pelatih')->with([

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
        $title = 'Tambah Data Pelatih - Admin';
        $data = CaborModel::get();


        return view('admin.pelatihtbh')->with([
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
                'id_cabor' => 'required',
                'id_club' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['nama'];
        $b = $request['id_cabor'];
        $c = $request['id_club'];
        $d = $request['tempat_lahir'];
        $e = $request['tgl_lahir'];
        $f = $request['nohp'];
        $g = $request['alamat'];
        $h = $request['file'];
        $i = $request['image'];

        //baru
        $aa = $request['no_sertifikat'];
        $bb = $request['tgl_sertifikat'];
        $cc = $request['masa_sertifikat'];
        $dd = $request['level'];

        if ($i == null) {
            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $file = $request->file('file');
            $inputdua['imagename'] = time() . '.' . $file->extension();
            $destinationPath = public_path('berkas/license/thumbnail');
            $img = Image::make($file->path());
            $img->resize(800, 800, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $inputdua['imagename']);
            $destinationPath = public_path('berkas/license');
            $file->move($destinationPath, $inputdua['imagename']);

            $simpan = PelatihModel::create([

                "nama" => $a,
                "id_cabor" => $b,
                "id_club" => $c,
                "tempat_lahir" => $d,
                "tgl_lahir" => $e,
                "nohp" => $f,
                "alamat" => $g,
                "file" => $inputdua['imagename'],

                // baru
                "no_sertifikat" => $aa,
                "tgl_sertifikat" => $bb,
                "masa_sertifikat" => $cc,
                "level" => $dd,

            ]);
            return redirect()->route('pelatih.index')->with('message', 'Data Berhasil Disimpan');
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                    'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $image = $request->file('image');
            $input['imagename'] = time() . '.' . $image->extension();
            $destinationPath = public_path('berkas/pelatih/thumbnail');
            $img = Image::make($image->path());
            $img->resize(600, 600, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/pelatih');
            $image->move($destinationPath, $input['imagename']);

            $file = $request->file('file');
            $inputdua['imagenamedua'] = time() . '.' . $file->extension();
            $destinationPathdua = public_path('berkas/license/thumbnail');
            $imgdua = Image::make($file->path());
            $imgdua->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathdua . '/' . $inputdua['imagenamedua']);
            $destinationPathdua = public_path('berkas/license');
            $file->move($destinationPathdua, $inputdua['imagenamedua']);

            $simpan = PelatihModel::create([
                "nama" => $a,
                "id_cabor" => $b,
                "id_club" => $c,
                "tempat_lahir" => $d,
                "tgl_lahir" => $e,
                "nohp" => $f,
                "alamat" => $g,
                "file" => $inputdua['imagenamedua'],
                "foto" => $input['imagename'],

                // baru
                "no_sertifikat" => $aa,
                "tgl_sertifikat" => $bb,
                "masa_sertifikat" => $cc,
                "level" => $dd,

            ]);
            return redirect()->route('pelatih.index')->with('message', 'Data Berhasil Disimpan');
        }
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'id_cabor' => 'required',
                'id_club' => 'required',


            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $id = $request['id'];

        $a = $request['nama'];
        $b = $request['id_cabor'];
        $c = $request['id_club'];
        $d = $request['tempat_lahir'];
        $e = $request['tgl_lahir'];
        $f = $request['nohp'];
        $g = $request['alamat'];
        $h = $request['file'];
        $i = $request['image'];

        //baru
        $aa = $request['no_sertifikat'];
        $bb = $request['tgl_sertifikat'];
        $cc = $request['masa_sertifikat'];
        $dd = $request['level'];



        if ($i == null and $h != null) {
            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $file = $request->file('file');
            $inputdua['imagename'] = time() . '.' . $file->extension();
            $destinationPath = public_path('berkas/license/thumbnail');
            $img = Image::make($file->path());
            $img->resize(800, 8000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $inputdua['imagename']);
            $destinationPath = public_path('berkas/license');
            $file->move($destinationPath, $inputdua['imagename']);

            $user = PelatihModel::findOrFail($id);
            $user->update([
                "nama" => $a,
                "id_cabor" => $b,
                "id_club" => $c,
                "tempat_lahir" => $d,
                "tgl_lahir" => $e,
                "nohp" => $f,
                "alamat" => $g,
                "file" => $inputdua['imagename'],

                // baru
                "no_sertifikat" => $aa,
                "tgl_sertifikat" => $bb,
                "masa_sertifikat" => $cc,
                "level" => $dd,
            ]);
            return redirect()->route('pelatih.index')->with('message', 'Data Berhasil Diupdate');
        } else if ($h == null and $i != null) {
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
            $destinationPath = public_path('berkas/pelatih/thumbnail');
            $img = Image::make($image->path());
            $img->resize(600, 600, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/pelatih');
            $image->move($destinationPath, $input['imagename']);
            $user = PelatihModel::findOrFail($id);
            $user->update([
                "nama" => $a,
                "id_cabor" => $b,
                "id_club" => $c,
                "tempat_lahir" => $d,
                "tgl_lahir" => $e,
                "nohp" => $f,
                "alamat" => $g,
                "foto" => $input['imagename'],

                // baru
                "no_sertifikat" => $aa,
                "tgl_sertifikat" => $bb,
                "masa_sertifikat" => $cc,
                "level" => $dd,
            ]);
            return redirect()->route('pelatih.index')->with('message', 'Data Berhasil Diupdate');
        } else if ($h != null and $i != null) {
            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                    'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $image = $request->file('image');
            $input['imagename'] = time() . '.' . $image->extension();
            $destinationPath = public_path('berkas/pelatih/thumbnail');
            $img = Image::make($image->path());
            $img->resize(600, 600, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/pelatih');
            $image->move($destinationPath, $input['imagename']);

            $file = $request->file('file');
            $inputdua['imagenamedua'] = time() . '.' . $file->extension();
            $destinationPathdua = public_path('berkas/license/thumbnail');
            $imgdua = Image::make($file->path());
            $imgdua->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathdua . '/' . $inputdua['imagenamedua']);
            $destinationPathdua = public_path('berkas/license');
            $file->move($destinationPathdua, $inputdua['imagenamedua']);

            $user = PelatihModel::findOrFail($id);
            $user->update([
                "nama" => $a,
                "id_cabor" => $b,
                "id_club" => $c,
                "tempat_lahir" => $d,
                "tgl_lahir" => $e,
                "nohp" => $f,
                "alamat" => $g,
                "file" => $inputdua['imagenamedua'],
                "foto" => $input['imagename'],

                // baru
                "no_sertifikat" => $aa,
                "tgl_sertifikat" => $bb,
                "masa_sertifikat" => $cc,
                "level" => $dd,
            ]);
            return redirect()->route('pelatih.index')->with('message', 'Data Berhasil Diupdate');
        } else {
            $user = PelatihModel::findOrFail($id);
            $user->update([
                "nama" => $a,
                "id_cabor" => $b,
                "id_club" => $c,
                "tempat_lahir" => $d,
                "tgl_lahir" => $e,
                "nohp" => $f,
                "alamat" => $g,

                // baru
                "no_sertifikat" => $aa,
                "tgl_sertifikat" => $bb,
                "masa_sertifikat" => $cc,
                "level" => $dd,

            ]);
            return redirect()->route('pelatih.index')->with('message', 'Data Berhasil Diupdate');
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
        $title = 'Detail Data Pelatih - Admin';

        $data = DB::table('tb_pelatih')
            ->join('tb_cabor', 'tb_pelatih.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_pelatih.id_club', '=', 'tb_club.id')
            ->select('tb_pelatih.*', 'tb_cabor.cabor as namacabor',  'tb_club.club as namaclub', 'tb_club.alamat as alamatclub',)
            ->where('tb_pelatih.id', $id)->first();


        $tanggalLahir = $data->tgl_lahir;
        $usia = Carbon::parse($tanggalLahir)->age;


        $atlit = DB::table('tb_atlit')
            ->join('tb_cabor', 'tb_atlit.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_atlit.id_club', '=', 'tb_club.id')
            ->select('tb_atlit.*', 'tb_cabor.cabor as cabor', 'tb_club.club as club')
            ->where('tb_atlit.id_club', $data->id_club)->get();




        return view('admin.pelatihshow')->with([
            'data' => $data,
            'usia' => $usia,
            'atlit' => $atlit,
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
        $title = 'Edit Data Pelatih - Admin';
        $kat = CaborModel::get();

        $data = DB::table('tb_pelatih')
            ->join('tb_cabor', 'tb_pelatih.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_pelatih.id_club', '=', 'tb_club.id')
            ->select('tb_pelatih.*', 'tb_cabor.cabor as namacabor', 'tb_cabor.id as idkatcabor',  'tb_club.club as namaclub', 'tb_club.id as idkatclub')
            ->where('tb_pelatih.id', $id)->first();

        return view('admin.pelatihedit')->with([
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
        PelatihModel::find($id)->delete();
        return redirect()->route('pelatih.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
