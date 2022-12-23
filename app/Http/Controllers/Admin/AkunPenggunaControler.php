<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\CaborModel;
use App\Models\User;
use App\Models\IndukOrganModel;
use App\Models\AtlitModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\ClubModel;
use App\Models\PrestasiModel;
use App\Models\Juara;
use App\Models\Medali;
use Cabor;
use Validator;
use Image;
use DB;
use Carbon\Carbon;
use Hash;

class AkunPenggunaControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Akun Pengguna - Admin';

        $data =  DB::table('users')
            ->leftjoin('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->get();

        $cabor = DB::table('tb_cabor')->select('id', 'cabor')->get();

        return view('admin.akunpengguna')->with([
            'data' => $data,
            'cabor' => $cabor,
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
                'role' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',

            ],

        );
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $role = $request['role'];
        $a = $request['name'];
        $b = $request['email'];
        $c = bcrypt($request['password']);

        if ($role == 'sekre') {
            User::create(
                [
                    'name' => $a,
                    'email' => $b,
                    'password' => $c,
                    'is_admin' => 1,
                    'id_cabor' => 'sekre',

                ]

            );
        } else if ($role == 'humas') {
            User::create(
                [
                    'name' => $a,
                    'email' => $b,
                    'password' => $c,
                    'is_admin' => 1,
                    'id_cabor' => 'humas',

                ]

            );
        } else {
            User::create(
                [
                    'name' => $a,
                    'email' => $b,
                    'password' => $c,
                    'is_admin' => 2,
                    'id_cabor' => $role,

                ]

            );
        }
        return redirect()->route('akunpengguna.index')->with('message', 'Data Berhasil Disimpan');
    }

    public function updatedata(Request $request)
    {
        $id = $request['id'];
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
        $c = $request['password'];
        $pass = bcrypt($request['password']);





        if ($c == null) {

            $user = User::findOrFail($id);
            $user->update([

                "name" => $a,
                "email" => $b,

            ]);
            return redirect()->route('akunpengguna.index')->with('message', 'Data Berhasil Diupdate');
        } else {

            $validator = Validator::make(
                $request->all(),
                [
                    'password' => 'required|min:6',
                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }

            $user = User::findOrFail($id);
            $user->update([

                "name" => $a,
                "email" => $b,
                'password' => $pass,


            ]);
            return redirect()->route('akunpengguna.index')->with('message', 'Data Berhasil Diupdate');
        }
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
        $title = 'Edit Data Akun Pengguna - Admin';

        $data =  DB::table('users')
            ->leftjoin('tb_cabor', 'users.id_cabor', '=', 'tb_cabor.id')
            ->select('users.*', 'tb_cabor.cabor as cabor', 'tb_cabor.id as idcabor',)
            ->where('users.id', $id)->first();

        if ($data == null) {
            return abort(404);
        }

        $cabor = DB::table('tb_cabor')->select('id', 'cabor')->get();

        return view('admin.akunpenggunaedit')->with([
            'data' => $data,
            'cabor' => $cabor,
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
        User::find($id)->delete();
        return redirect()->route('akunpengguna.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
