<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CaborModel;
use Cabor;
use Validator;
use Image;
use DB;
use Carbon\Carbon;
use Hash;
use Auth;

class AkunControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengaturan Akun - Admin';
        $detail = DB::table('users')
            ->select('users.*')
            ->where('users.id', auth()->user()->id)->first();


        return view('admin.akun')->with([

            'detail' => $detail,
            'title' => $title,

        ]);
    }


    public function store(Request $request)
    {
        $id =  auth()->user()->id;
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['name'];
        $b = $request['email'];
        $g = $request['image'];

        if ($g == null) {
            $user = User::findOrFail($id);
            $user->update([
                "name" => $a,
                "email" => $b,

            ]);

            return redirect()->route('akun.index')->with('message', 'Data Berhasil Disimpan');
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $image = $request->file('image');
            $input['imagename'] = time() . '.' . $image->extension();
            $destinationPath = public_path('berkas/akun/thumbnail');
            $img = Image::make($image->path());
            $img->resize(500, 500, function ($constraint) {
                // $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $destinationPath = public_path('berkas/akun');
            $image->move($destinationPath, $input['imagename']);

            $user = User::findOrFail($id);
            $user->update([
                "name" => $a,
                "email" => $b,
                "foto" => $input['imagename'],

            ]);


            return redirect()->route('akun.index')->with('message', 'Data Berhasil Disimpan');
        }
    }

    public function changePasswordPost(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "ERRORR !! Password Lama tidak cocok dengan yang anda inputkan.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "ERROR !! Passsword Baru tidak boleh sama dengan Password Anda saat ini.");
        }


        $validator = Validator::make(
            $request->all(),
            [
                'current-password' => 'required',
                'new-password' => 'required|string|min:8|confirmed',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Password Berhasil Diganti");
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
    public function aturcabor()
    {
        $title = 'Pengaturan Cabor - Cabor';
        $detail = DB::table('users')
            ->join('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor', 'tb_cabor.id_induk as idinduk')
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();



        $data = DB::table('tb_cabor')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_cabor.*', 'indukorganisasi.panjang as indukp', 'indukorganisasi.pendek as indukpendek', 'indukorganisasi.id as idkat')
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        return view('cabor.aturcabor')->with([
            'data' => $data,
            'detail' => $detail,
            'title' => $title,

        ]);
    }

    public function updatedata(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cabor' => 'required',
                'id_induk' => 'required',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $id = $request['id'];
        $a = $request['cabor'];
        $b = $request['id_induk'];
        $c = $request['alamat'];
        $d = $request['sk'];
        $e = $request['lat'];
        $f = $request['lng'];
        $g = $request['image'];

        //baru
        $aa = $request['tgl_terbit'];
        $bb = $request['tgl_berakhir'];
        $cc = $request['nama_ketua'];
        $dd = $request['nama_sekretaris'];
        $ee = $request['nama_bendahara'];
        $ff = $request['jml_pengurus'];
        $gg = $request['no_surat_koni'];
        $hh = $request['tgl_surat_koni'];



        if ($e == null) {
            if ($g == null) {
                $user = CaborModel::findOrFail($id);
                $user->update([
                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,
                ]);

                return redirect()->back()->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/cabor/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/cabor');
                $image->move($destinationPath, $input['imagename']);

                $user = CaborModel::findOrFail($id);
                $user->update([
                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,

                    "logo" => $input['imagename'],

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,
                ]);


                return redirect()->back()->with('message', 'Data Berhasil Disimpan');
            }
        } else {
            if ($g == null) {
                $user = CaborModel::findOrFail($id);
                $user->update([
                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,
                    "lat" => $e,
                    "lng" => $f,

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,
                ]);

                return redirect()->back()->with('message', 'Data Berhasil Disimpan');
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
                $destinationPath = public_path('berkas/cabor/thumbnail');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $input['imagename']);
                $destinationPath = public_path('berkas/cabor');
                $image->move($destinationPath, $input['imagename']);

                $user = CaborModel::findOrFail($id);
                $user->update([
                    "cabor" => $a,
                    "id_induk" => $b,
                    "alamat" => $c,
                    "sk" => $d,
                    "lat" => $e,
                    "lng" => $f,
                    "logo" => $input['imagename'],

                    //baru
                    "tgl_terbit" => $aa,
                    "tgl_berakhir" => $bb,
                    "nama_ketua" => $cc,
                    "nama_sekretaris" => $dd,
                    "nama_bendahara" => $ee,
                    "jml_pengurus" => $ff,
                    "no_surat_koni" => $gg,
                    "tgl_surat_koni" => $hh,
                ]);


                return redirect()->back()->with('message', 'Data Berhasil Disimpan');
            }
        }
        //


    }
}
