<?php

namespace App\Http\Controllers\Cabor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasitModel;
use Validator;
use DB;
use Image;
use Carbon\Carbon;

class CwasitControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Wasit/Juri - Cabor';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $data = WasitModel::where('id_cabor', auth()->user()->id_cabor)->get();




        return view('cabor.wasit')->with([
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
        $title = 'Tambah Data Wasit/Juri - Cabor';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        return view('cabor.wasittbh')->with([
            'title' => $title,
            'detail' => $detail,

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
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $idcabor = $request['id_cabor'];
        $a = $request['nama'];
        $b = $request['tempat_lahir'];
        $c = $request['tgl_lahir'];
        $d = $request['nohp'];
        $e = $request['no_sertifikat'];
        $f = $request['tgl_terbit'];
        $g = $request['masa_sertifikat'];
        $h = $request['level'];
        $i = $request['image'];

        if ($i != null) {
            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $file = $request->file('image');
            $inputdua['imagename'] = time() . '.' . $file->extension();
            $destinationPath = public_path('berkas/wasit/thumbnail');
            $img = Image::make($file->path());
            $img->resize(600, 600, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $inputdua['imagename']);
            $destinationPath = public_path('berkas/wasit');
            $file->move($destinationPath, $inputdua['imagename']);

            $simpan = WasitModel::create([

                "nama" => $a,
                "tempat_lahir" => $b,
                "tgl_lahir" => $c,
                "nohp" => $d,
                "no_sertifikat" => $e,
                "tgl_terbit" => $f,
                "masa_sertifikat" => $g,
                "level" => $h,
                "foto" => $inputdua['imagename'],
                //
                "id_cabor" => $idcabor,

            ]);
            return redirect()->route('cwasit.index')->with('message', 'Data Berhasil Disimpan');
        } else {

            $simpan = WasitModel::create([

                "nama" => $a,
                "tempat_lahir" => $b,
                "tgl_lahir" => $c,
                "nohp" => $d,
                "no_sertifikat" => $e,
                "tgl_terbit" => $f,
                "masa_sertifikat" => $g,
                "level" => $h,
                "id_cabor" => $idcabor,


            ]);
            return redirect()->route('cwasit.index')->with('message', 'Data Berhasil Disimpan');
        }
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $idcabor = $request['id_cabor'];

        $id = $request['id'];
        $a = $request['nama'];
        $b = $request['tempat_lahir'];
        $c = $request['tgl_lahir'];
        $d = $request['nohp'];
        $e = $request['no_sertifikat'];
        $f = $request['tgl_terbit'];
        $g = $request['masa_sertifikat'];
        $h = $request['level'];
        $i = $request['image'];

        if ($i != null) {
            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $file = $request->file('image');
            $inputdua['imagename'] = time() . '.' . $file->extension();
            $destinationPath = public_path('berkas/wasit/thumbnail');
            $img = Image::make($file->path());
            $img->resize(600, 600, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $inputdua['imagename']);
            $destinationPath = public_path('berkas/wasit');
            $file->move($destinationPath, $inputdua['imagename']);

            $user = WasitModel::findOrFail($id);
            $user->update([

                "nama" => $a,
                "tempat_lahir" => $b,
                "tgl_lahir" => $c,
                "nohp" => $d,
                "no_sertifikat" => $e,
                "tgl_terbit" => $f,
                "masa_sertifikat" => $g,
                "level" => $h,
                "foto" => $inputdua['imagename'],
                "id_cabor" => $idcabor,

            ]);
            return redirect()->route('cwasit.index')->with('message', 'Data Berhasil Disimpan');
        } else {

            $user = WasitModel::findOrFail($id);
            $user->update([

                "nama" => $a,
                "tempat_lahir" => $b,
                "tgl_lahir" => $c,
                "nohp" => $d,
                "no_sertifikat" => $e,
                "tgl_terbit" => $f,
                "masa_sertifikat" => $g,
                "level" => $h,
                "id_cabor" => $idcabor,


            ]);
            return redirect()->route('cwasit.index')->with('message', 'Data Berhasil Disimpan');
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
        $title = 'Detail Data Wasit - Admin';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $data = DB::table('tb_wasit')
            ->select('tb_wasit.*')
            ->where('tb_wasit.id_cabor', auth()->user()->id_cabor)->where('tb_wasit.id', $id)->first();
        if ($data == null) {
            return abort(404);
        }

        $tanggalLahir = $data->tgl_lahir;
        $usia = Carbon::parse($tanggalLahir)->age;




        return view('cabor.wasitshow')->with([
            'data' => $data,
            'usia' => $usia,
            'detail' => $detail,
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
        $title = 'Edit Data Wasit - Cabor';

        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $data = DB::table('tb_wasit')
            ->select('tb_wasit.*')
            ->where('tb_wasit.id_cabor', auth()->user()->id_cabor)->where('tb_wasit.id', $id)->first();

        if ($data == null) {
            return abort(404);
        }

        return view('cabor.wasitedit')->with([
            'data' => $data,
            'detail' => $detail,
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        WasitModel::find($id)->delete();
        return redirect()->route('cwasit.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
