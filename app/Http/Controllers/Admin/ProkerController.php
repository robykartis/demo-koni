<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProkerModel;
use Illuminate\Http\Request;
use Validator;

class ProkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Program Kerja - Admin';
        $data = ProkerModel::first();

        return view('admin.proker')->with([
            'data' => $data,
            'title' => $title,
        ]);
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required',


            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }


        $id = $request['id'];
        $a = $request['judul'];
        $b = $request['isi'];

        $user = ProkerModel::findOrFail($id);
        $user->update([
            "judul" => $a,
            "isi" => $b,



        ]);
        return  redirect()->route('proker.index')->with('message', 'Data Berhasil Diupdate');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
