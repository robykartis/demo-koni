<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasitModel;
use App\Models\VideoModel;

use Validator;
use DB;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Str;


class VideoControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Galeri Video - Admin';

        $data = VideoModel::get();

        return view('admin.video')->with([
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
        $title = 'Tambah Data Galeri Video - Admin';

        return view('admin.videotbh')->with([

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
                'tgl' => 'required',
                'video' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }

        $a = $request['judul'];
        $b = $request['tgl'];
        $c = $request['isi'];
        $d = $request['video'];

        $slugrandom = Str::random(4);
        $slug = Str::slug($a, '-');

        $hasilslug = "$slug-$slugrandom";

        $simpan = VideoModel::create([

            "judul" => $a,
            "slug" => $hasilslug,
            "tgl" => $b,
            "isi" => $c,
            "video" => $d,

        ]);
        return redirect()->route('video.index')->with('message', 'Data Berhasil Disimpan');
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required',
                'tgl' => 'required',
                'video' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $id = $request['id'];
        $a = $request['judul'];
        $b = $request['tgl'];
        $c = $request['isi'];
        $d = $request['video'];
        $slugrandom = Str::random(4);
        $slug = Str::slug($a, '-');

        $hasilslug = "$slug-$slugrandom";

        $user = VideoModel::findOrFail($id);
        $user->update([

            "judul" => $a,
            "tgl" => $b,
            "isi" => $c,
            "video" => $d,
            "slug" => $hasilslug,


        ]);
        return redirect()->route('video.index')->with('message', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail Data Galeri Video - Admin';


        $data = VideoModel::findOrFail($id);

        $playvideo =  substr($data->video, -11);
        if ($data == null) {
            return abort(404);
        }


        return view('admin.videoshow')->with([
            'data' => $data,
            'playvideo' => $playvideo,

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
        $title = 'Edit Data Galeri Video - Admin';


        $data = VideoModel::findOrFail($id);


        if ($data == null) {
            return abort(404);
        }
        return view('admin.videoedit')->with([
            'data' => $data,
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
        VideoModel::find($id)->delete();
        return redirect()->route('video.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
