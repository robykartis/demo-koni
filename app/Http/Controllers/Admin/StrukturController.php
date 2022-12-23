<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturModel;
use Illuminate\Http\Request;
use Validator;
use Image;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Struktur Organisasi - Admin';
        $data = StrukturModel::first();

        return view('admin.struktur')->with([
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
        $z = $request['image'];



        if ($z == null) {
            $user = StrukturModel::findOrFail($id);
            $user->update([
                "judul" => $a,


            ]);
            return  redirect()->route('struktur.index')->with('message', 'Data Berhasil Diupdate');
        } else {
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
            $destinationPath = public_path('berkas/struktur/thumbnail');
            $img = Image::make($image->path());
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/struktur');
            $image->move($destinationPath, $input['imagename']);


            $user = StrukturModel::findOrFail($id);
            $user->update([
                "judul" => $a,

                "foto" => $input['imagename'],


            ]);
            return  redirect()->route('struktur.index')->with('message', 'Data Berhasil Diupdate');
        }
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
