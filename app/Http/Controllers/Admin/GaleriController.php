<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalfotModel;
use App\Models\FotoKontenModel;
use App\Models\FotoModel;
use Illuminate\Support\Str;
use Validator;
use Image;
use DB;
use Carbon\Carbon;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Galeri Foto - Admin';


        $data = FotoKontenModel::get();

        return view('admin.galeri')->with([
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
        $title = 'Tambah Data Galeri Foto - Admin';
        $data = GalfotModel::get();


        return view('admin.galeritbh')->with([
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
                'tgl' => 'required',
                'judul' => 'required',
                'isi' => 'required',
                'addmore.*.image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }

        $keypres = random_int(10000000, 99999999);

        $a = $request['judul'];
        $b = $request['isi'];
        $c = $request['tgl'];

        $slugrandom = Str::random(4);
        $slug = Str::slug($a, '-');
        $hasilslug = "$slug-$slugrandom";

        foreach ($request->file('addmore.*.image') as $key => $image) {
            $name = $image->getClientOriginalName();
            $namefile = $input['imagename'] = time() . '.' . $name;
            $destinationPath = public_path('berkas/galerifoto/thumbnail');
            $img = Image::make($image->path());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $namefile);
            $destinationPath = public_path('berkas/galerifoto');
            $image->move($destinationPath, $namefile);

            $simpan = FotoModel::create([

                "id_galeri" => $keypres,
                "foto" => $namefile,

            ]);
        }
        $simpan = FotoKontenModel::create([
            "id" => $keypres,
            "judul" => $a,
            "tgl" => $c,
            "id_galkat" => $hasilslug,
            "isi" => $b,

        ]);

        return redirect()->route('galerifoto.index')->with('message', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail Data Galeri - Admin';

        $data = DB::table('tb_foto_konten')
            ->where('id', $id)->first();

        if ($data == null) {
            return abort(404);
        }
        $allfoto = DB::table('tb_foto')->where('id_galeri', $data->id)->get();

        return view('admin.galerishow')->with([
            'data' => $data,
            'title' => $title,
            'allfoto' => $allfoto,

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
        //
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
        FotoKontenModel::find($id)->delete();
        return redirect()->route('galerifoto.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
