<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilModel;
use Illuminate\Http\Request;
use Image;
use Validator;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Profil Koni - Admin';
        $data = ProfilModel::first();

        return view('admin.profil')->with([
            'data' => $data,
            'title' => $title,
        ]);
    }



    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }


        $id = $request['id'];
        $a = $request['nama'];
        $b = $request['email'];
        $c = $request['telp'];
        $d = $request['alamat'];
        $e = $request['fb'];
        $f = $request['ig'];
        $g = $request['yt'];
        $h = $request['deskripsi'];
        $z = $request['image'];

        $lat = $request['lat'];
        $lng = $request['lng'];

        if ($lat != null) {
            if ($z == null) {
                $user = ProfilModel::findOrFail($id);
                $user->update([
                    "nama" => $a,
                    "email" => $b,
                    "telp" => $c,
                    "alamat" => $d,
                    "fb" => $e,
                    "ig" => $f,
                    "yt" => $g,
                    "deskripsi" => $h,
                    "lat" => $lat,
                    "lng" => $lng,


                ]);
                return  redirect()->route('profil.index')->with('message', 'Data Berhasil Diupdate');
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
                $destinationPath = public_path('berkas/profil/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/profil');
                $image->move($destinationPath, $input['imagename']);


                $user = ProfilModel::findOrFail($id);
                $user->update([
                    "nama" => $a,
                    "email" => $b,
                    "telp" => $c,
                    "alamat" => $d,
                    "fb" => $e,
                    "ig" => $f,
                    "yt" => $g,
                    "deskripsi" => $h,
                    "logo" => $input['imagename'],
                    "lat" => $lat,
                    "lng" => $lng,

                ]);
                return  redirect()->route('profil.index')->with('message', 'Data Berhasil Diupdate');
            }
        } else {
            if ($z == null) {
                $user = ProfilModel::findOrFail($id);
                $user->update([
                    "nama" => $a,
                    "email" => $b,
                    "telp" => $c,
                    "alamat" => $d,
                    "fb" => $e,
                    "ig" => $f,
                    "yt" => $g,
                    "deskripsi" => $h,



                ]);
                return  redirect()->route('profil.index')->with('message', 'Data Berhasil Diupdate');
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
                $destinationPath = public_path('berkas/profil/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/profil');
                $image->move($destinationPath, $input['imagename']);


                $user = ProfilModel::findOrFail($id);
                $user->update([
                    "nama" => $a,
                    "email" => $b,
                    "telp" => $c,
                    "alamat" => $d,
                    "fb" => $e,
                    "ig" => $f,
                    "yt" => $g,
                    "deskripsi" => $h,
                    "logo" => $input['imagename'],


                ]);
                return  redirect()->route('profil.index')->with('message', 'Data Berhasil Diupdate');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
