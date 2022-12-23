<?php

namespace App\Http\Controllers\Cabor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaborModel;
use App\Models\ClubModel;
use App\Models\PelatihModel;
use Validator;
use DB;
use Image;
use Carbon\Carbon;
use DataTables;

class CpelatihControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Pelatih - Cabor';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $club = ClubModel::where('id_cabor', auth()->user()->id_cabor)->get();

        // $data = DB::table('tb_pelatih')
        //     ->join('tb_cabor', 'tb_pelatih.id_cabor', '=', 'tb_cabor.id')
        //     ->join('tb_club', 'tb_pelatih.id_club', '=', 'tb_club.id')
        //     ->select('tb_pelatih.*', 'tb_cabor.cabor as namacabor',  'tb_club.club as namaclub',)
        //     ->where('tb_pelatih.id_cabor', auth()->user()->id_cabor)->get();




        return view('cabor.pelatih')->with([
            // 'data' => $data,
            'club' => $club,
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
        $title = 'Tambah Data Pelatih - Cabor';

        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();
        $data = ClubModel::where('id_cabor', auth()->user()->id_cabor)->get();


        return view('cabor.pelatihtbh')->with([
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
                'nama' => 'required',
                'id_cabor' => 'required',
                'id_club' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $editor = auth()->user()->id;
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
                //
                "editor" => $editor,

            ]);
            return redirect()->route('cpelatih.index')->with('message', 'Data Berhasil Disimpan');
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

                //
                "editor" => $editor,

            ]);
            return redirect()->route('cpelatih.index')->with('message', 'Data Berhasil Disimpan');
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
            return redirect()->route('cpelatih.index')->with('message', 'Data Berhasil Diupdate');
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
            return redirect()->route('cpelatih.index')->with('message', 'Data Berhasil Diupdate');
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
            return redirect()->route('cpelatih.index')->with('message', 'Data Berhasil Diupdate');
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
            return redirect()->route('cpelatih.index')->with('message', 'Data Berhasil Diupdate');
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
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $data = DB::table('tb_pelatih')
            ->join('tb_cabor', 'tb_pelatih.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_pelatih.id_club', '=', 'tb_club.id')
            ->select('tb_pelatih.*', 'tb_cabor.cabor as namacabor',  'tb_club.club as namaclub', 'tb_club.alamat as alamatclub',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->where('tb_pelatih.id', $id)->first();
        if ($data == null) {
            return abort(404);
        }

        $tanggalLahir = $data->tgl_lahir;
        $usia = Carbon::parse($tanggalLahir)->age;


        $atlit = DB::table('tb_atlit')
            ->join('tb_cabor', 'tb_atlit.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_atlit.id_club', '=', 'tb_club.id')
            ->select('tb_atlit.*', 'tb_cabor.cabor as cabor', 'tb_club.club as club')
            ->where('tb_atlit.id_club', $data->id_club)->get();




        return view('cabor.pelatihshow')->with([
            'data' => $data,
            'detail' => $detail,
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
        $title = 'Edit Data Pelatih - Cabor';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $kat = ClubModel::where('id_cabor', auth()->user()->id_cabor)->get();


        $data = DB::table('tb_pelatih')
            ->join('tb_cabor', 'tb_pelatih.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_pelatih.id_club', '=', 'tb_club.id')
            ->select('tb_pelatih.*', 'tb_cabor.cabor as namacabor', 'tb_cabor.id as idkatcabor',  'tb_club.club as namaclub', 'tb_club.id as idkatclub')
            ->where('tb_cabor.id', auth()->user()->id_cabor)->where('tb_pelatih.id', $id)->first();
        if ($data == null) {
            return abort(404);
        }
        return view('cabor.pelatihedit')->with([
            'data' => $data,
            'detail' => $detail,
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
        return redirect()->route('cpelatih.index')
            ->with('message', 'Data Berhasil Dihapus');
    }

    public function hapuspel(Request $request, $id)
    {
        //fungsi eloquent untuk menghapus data
        PelatihModel::find($id)->delete();


        return redirect()->route('cpelatih.index')
            ->with('message', 'Data Berhasil Dihapus');
    }

    public function fetchClub(Request $request)
    {
        $data['states'] = ClubModel::where("id_cabor", $request->kec_id)->get(["club", "id"]);
        return response()->json($data);
    }

    public function get_pelatih(Request $request)
    {



        $postsQuery = DB::table('tb_pelatih')
            ->join('tb_cabor', 'tb_pelatih.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_pelatih.id_club', '=', 'tb_club.id');


        if ($_GET["status_cabor"] == '' && $_GET["status_club"] == '') {

            $postsQuery;
        } else if ($_GET["status_cabor"] != '' && $_GET["status_club"] == '') {
            $status_cabor = $_GET['status_cabor'];
            $postsQuery->whereRaw("tb_pelatih.id_cabor = '" . $status_cabor . "' ");
        } else if ($_GET["status_cabor"] != '' && $_GET["status_club"] != '') {
            $status_cabor = $_GET['status_cabor'];
            $status_club = $_GET['status_club'];
            $postsQuery->whereRaw("tb_pelatih.id_cabor = '" . $status_cabor . "' and tb_pelatih.id_club = '" . $status_club . "' ");
        }

        $posts = $postsQuery->select('tb_pelatih.*', 'tb_cabor.cabor as namacabor',  'tb_club.club as namaclub',);
        return datatables()->of($posts)->addIndexColumn()->addColumn('action', function ($posts) {
            $btn = '<a href="detaildata" class="text-info"></a>';
            return $btn;
        })->escapeColumns('action')
            ->addColumn('foto', function ($posts) {
                $url = asset('berkas/pelatih/thumbnail/' . $posts->foto);
                $btn = '<img src="' . $url . '" style="width:50px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="' . route('cpelatih.show', $posts->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-info-square me-0"></i></a> ';


                $btn = $btn . '<a href="' . route('cpelatih.edit', $posts->id) . '" class="btn btn-info btn-sm"><i class="bx bx-edit me-0"></i></a>';

                $btn = $btn . '  <a href="' . url('cabor/cpelatih/hapus', $posts->id) . '" class="btn btn-danger btn-sm"><i class="bx bx-trash me-0"></i></a>';



                return $btn;
            })->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('tb_club.club', 'LIKE', "%$search%")
                            ->orWhere('tb_cabor.cabor', 'LIKE', "%$search%")
                            ->orWhere('tb_pelatih.nama', 'LIKE', "%$search%");
                    });
                }
            })->rawColumns(['action', 'foto'])->make(true);
    }
}
