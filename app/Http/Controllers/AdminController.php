<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilModel;
use App\Models\SliderModel;
use App\Models\BeritaModel;
use App\Models\ProkerModel;
use App\Models\CaborModel;
use App\Models\ClubModel;
use App\Models\Medali;
use App\Models\PelatihModel;
use Cabor;
use Validator;
use Image;
use DB;
use Carbon\Carbon;
use DataTables;

class AdminController extends Controller
{

    public function index()
    {
        $title = 'Dashboard - Admin';
        $tinduk = DB::table('indukorganisasi')
            ->select('id')->count();
        $tcabor = DB::table('tb_cabor')
            ->select('id')->count();
        $tclub = DB::table('tb_club')
            ->select('id')->count();
        $tpelatih = DB::table('tb_pelatih')
            ->select('id')->count();
        $tatlit = DB::table('tb_atlit')
            ->select('id')->count();
        $twasit = DB::table('tb_wasit')
            ->select('id')->count();

        $tp = DB::table('tb_prestasi')->select('id')->count();
        $pres = DB::table('tb_prestasi')
            ->join('tb_medali', 'tb_prestasi.medali', '=', 'tb_medali.id')
            ->select(DB::raw('tb_medali.medali as date,count(tb_prestasi.id) as units'))
            ->groupBy('tb_medali.medali')->orderBy('tb_prestasi.medali', 'ASC')
            ->get();




        $datacabor = DB::table('tb_cabor')
            ->select('tb_cabor.*')
            ->get();

        $dataclub = DB::table('tb_club')
            ->join('tb_cabor', 'tb_club.id_cabor', '=', 'tb_cabor.id')
            ->select('tb_club.*', 'tb_cabor.cabor as namacabor', 'tb_cabor.id as idcabor')
            ->get();

        $mapcabor = [];
        foreach ($datacabor as $mapcab) {
            $mapcabor[] = [
                $mapcab->id,
                $mapcab->lat,
                $mapcab->lng,
                $mapcab->cabor,
                $mapcab->logo,

            ];
        }

        $mapclub = [];
        foreach ($dataclub as $mapc) {
            $mapclub[] = [
                $mapc->id,
                $mapc->lat,
                $mapc->lng,
                $mapc->club,
                $mapc->logo,

            ];
        }



        return view('admin/adminHome')->with(
            [
                'title' => $title,
                'tclub' => $tclub,
                'tpelatih' => $tpelatih,
                'tatlit' => $tatlit,
                'twasit' => $twasit,
                'tinduk' => $tinduk,
                'tcabor' => $tcabor,
                'tp' => $tp,
                'pres' => $pres,
                'mapclub' => $mapclub,
                'mapcabor' => $mapcabor,
            ]
        );
    }

    public function cabor()
    {

        $title = 'Dashboard - Cabor';



        $detail = DB::table('tb_cabor')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_cabor.*', 'indukorganisasi.panjang as indukp', 'indukorganisasi.pendek as indukpendek')
            ->where('tb_cabor.id', auth()->user()->id_cabor)->first();

        $tclub = DB::table('tb_club')
            ->select('id')->where('id_cabor', auth()->user()->id_cabor)->count();
        $tpelatih = DB::table('tb_pelatih')
            ->select('id')->where('id_cabor', auth()->user()->id_cabor)->count();
        $tatlit = DB::table('tb_atlit')
            ->select('id')->where('id_cabor', auth()->user()->id_cabor)->count();
        $twasit = DB::table('tb_wasit')
            ->select('id')->where('id_cabor', auth()->user()->id_cabor)->count();



        return view('cabor/caborHome')->with(
            [
                'title' => $title,
                'detail' => $detail,
                'tclub' => $tclub,
                'tpelatih' => $tpelatih,
                'tatlit' => $tatlit,
                'twasit' => $twasit,
            ]
        );
    }
}
