<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgendaFotoModel;
use App\Models\AgendaModel;
use Illuminate\Http\Request;
use App\Models\GalfotModel;
use App\Models\FotoKontenModel;
use App\Models\FotoModel;
use Illuminate\Support\Str;
use Validator;
use Image;
use DB;
use Carbon\Carbon;

class AgendaControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Agenda - Admin';
        $data = AgendaModel::get();

        return view('admin.agenda')->with([
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
        $title = 'Tambah Data Agenda Kegiatan - Admin';
        $data = GalfotModel::get();


        return view('admin.agendatbh')->with([
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
                'id_kat' => 'required',
                'waktu' => 'required',
                'tempat' => 'required',
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
        $c = $request['waktu'];
        $d = $request['tempat'];
        $e = $request['id_kat'];


        $slugrandom = Str::random(4);
        $slug = Str::slug($a, '-');
        $hasilslug = "$slug-$slugrandom";

        foreach ($request->file('addmore.*.image') as $key => $image) {
            $name = $image->getClientOriginalName();
            $namefile = $input['imagename'] = time() . '.' . $name;
            $destinationPath = public_path('berkas/agenda/thumbnail');
            $img = Image::make($image->path());
            $img->resize(800, 800, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $namefile);
            $destinationPath = public_path('berkas/agenda');
            $image->move($destinationPath, $namefile);

            $simpan = AgendaFotoModel::create([

                "id_agenda" => $keypres,
                "foto" => $namefile,
            ]);
        }
        $simpan = AgendaModel::create([
            "id" => $keypres,
            "slug" => $hasilslug,
            "judul" => $a,
            "waktu" => $c,
            "isi" => $b,
            "tempat" => $d,
            "id_kat" => $e,

        ]);

        return redirect()->route('agenda.index')->with('message', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail Data Agenda - Admin';

        $data = DB::table('tb_agenda')
            ->where('id', $id)->first();
        $data = DB::table('tb_agenda')
            ->join('tb_galfot', 'tb_agenda.id_kat', '=', 'tb_galfot.id')
            ->select('tb_agenda.*', 'tb_galfot.nama as namakat', 'tb_galfot.id as idkat',)
            ->where('tb_agenda.id', $id)->first();

        if ($data == null) {
            return abort(404);
        }
        $allfoto = DB::table('tb_agenda_foto')->where('id_agenda', $data->id)->get();

        return view('admin.agendashow')->with([
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
        AgendaModel::find($id)->delete();
        AgendaFotoModel::where('id_agenda', $id)->delete();
        return redirect()->route('agenda.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
