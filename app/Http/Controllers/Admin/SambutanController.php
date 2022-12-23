<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SambutanModel;
use App\Models\PengurusModel;
use Image;
use Validator;
use DB;
use Carbon\Carbon;
use Pengurus;

class SambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Sambutan Website - Admin';
        $kat = PengurusModel::get();
        $data = DB::table('tb_sambutan')
            ->join('tb_pengurus', 'tb_sambutan.id_pengurus', '=', 'tb_pengurus.id')
            ->select('tb_sambutan.*', 'tb_pengurus.nama as namapeng',  'tb_pengurus.id as idpeng', 'tb_pengurus.jabatan as jabatan')
            ->first();

        // dd($data);
        return view('admin.sambutan')->with([
            'data' => $data,
            'kat' => $kat,
            'title' => $title,
        ]);
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_pengurus' => 'required',
                'isi' => 'required',
            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }

        $id = $request['id'];
        $a = $request['id_pengurus'];
        $b = $request['isi'];

        $user = SambutanModel::findOrFail($id);
        $user->update([
            "id_pengurus" => $a,
            "isi" => $b,

        ]);
        return  redirect()->route('sambutan.index')->with('message', 'Data Berhasil Diupdate');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //
    }
}
