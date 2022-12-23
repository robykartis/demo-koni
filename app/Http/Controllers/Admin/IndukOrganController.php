<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndukOrganModel;
use Illuminate\Http\Request;
use Validator;

class IndukOrganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Induk Organisasi - Admin';
        $data = IndukOrganModel::get();
        return view('admin.indukorganisasi')->with([
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
        //
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pendek' => 'required',
                'panjang' => 'required',


            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }


        $id = $request['id'];
        $a = $request['pendek'];
        $b = $request['panjang'];

        $user = IndukOrganModel::findOrFail($id);
        $user->update([
            "pendek" => $a,
            "panjang" => $b,
        ]);
        return  redirect()->route('indukorganisasi.index')->with('message', 'Data Berhasil Diupdate');
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
                'pendek' => 'required',
                'panjang' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['pendek'];
        $b = $request['panjang'];

        $simpan = IndukOrganModel::create([

            "pendek" => $a,
            "panjang" => $b,
        ]);
        return redirect()->route('indukorganisasi.index')->with('message', 'Data Berhasil Disimpan');
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
        $title = 'Edit Data Induk Organisasi - Admin';


        $data = IndukOrganModel::where('id', $id)->first();

        return view('admin.indukedit')->with([
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
        IndukOrganModel::find($id)->delete();
        return redirect()->route('indukorganisasi.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
