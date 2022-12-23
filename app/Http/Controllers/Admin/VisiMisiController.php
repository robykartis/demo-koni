<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisiModel;
use Illuminate\Http\Request;
use Validator;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Visi Misi - Admin';
        $data = VisiMisiModel::first();

        return view('admin.visimisi')->with([
            'data' => $data,
            'title' => $title,
        ]);
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'visi' => 'required',


            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }


        $id = $request['id'];
        $a = $request['visi'];
        $b = $request['misi'];

        $user = VisiMisiModel::findOrFail($id);
        $user->update([
            "visi" => $a,
            "misi" => $b,



        ]);
        return  redirect()->route('visimisi.index')->with('message', 'Data Berhasil Diupdate');
    }
}
