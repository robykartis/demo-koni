<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProfilModel;
use App\Models\SliderModel;
use App\Models\BeritaModel;
use App\Models\ProkerModel;
use App\Models\CaborModel;
use App\Models\ClubModel;
use App\Models\FotoKontenModel;
use App\Models\FotoModel;
use App\Models\Medali;
use App\Models\PelatihModel;
use App\Models\VideoModel;
use App\Models\VisotorModel;
use Cabor;
use Validator;
use Image;
use DB;
use Carbon\Carbon;
use DataTables;
use Visitor;
use App\Models\AgendaModel;

class BeritaPublikController extends Controller
{
    public function beritashow(Request $request, $slug)
    {
        $profil = ProfilModel::first();

        $title = 'Berita Detail - ' . $profil->nama;

        $detail =  BeritaModel::join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->select(['tb_berita.*', 'tb_beritakat.nama as kategoriberita'])
            ->where('tb_berita.slug', $slug)->first();
        if ($detail == null) {
            return abort(404);
        }
        $tags = explode(",", $detail->tag);



        // manual count visitor
        $ip = $request->getClientIp();
        $visit_date = Carbon::now()->toDateString();
        $cek = VisotorModel::where('ip', '=', $ip)->where('date', $visit_date)->where('hits', $detail->id)->first();
        if ($cek === null) {
            $vt = $detail->visitor;
            $vh = $vt + 1;
            // user doesn't exist
            VisotorModel::create(
                [
                    'hits' => $detail->id,
                    'ip' => $ip,
                    'date' => $visit_date,

                ]

            );
            $user = BeritaModel::findOrFail($detail->id);
            $user->update([
                "visitor" => $vh,

            ]);
        }

        $agenda = AgendaModel::take(5)->get();

        $populer = BeritaModel::orderBy('visitor', 'DESC')->take(5)->get();


        return view('beritashow')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'detail' => $detail,
                'agenda' => $agenda,
                'populer' => $populer,
            ]
        );
    }

    public function galerifotoshow(Request $request, $slug)
    {
        $profil = ProfilModel::first();

        $title = 'Galeri Foto Detail - ' . $profil->nama;


        $detail = FotoKontenModel::where('id_galkat', $slug)->first();

        if ($detail == null) {
            return abort(404);
        }
        $allfoto = FotoModel::where('id_galeri', $detail->id)->get();
        $agenda = AgendaModel::take(5)->get();

        $populer = BeritaModel::orderBy('visitor', 'DESC')->take(5)->get();

        return view('galerifotoshow')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'detail' => $detail,
                'allfoto' => $allfoto,
                'agenda' => $agenda,
                'populer' => $populer,
            ]
        );
    }

    public function galerivideoshow(Request $request, $slug)
    {
        $profil = ProfilModel::first();

        $title = 'Galeri Video Detail - ' . $profil->nama;


        $detail = VideoModel::where('slug', $slug)->first();

        if ($detail == null) {
            return abort(404);
        }

        $agenda = AgendaModel::take(5)->get();

        $populer = BeritaModel::orderBy('visitor', 'DESC')->take(5)->get();


        return view('galerivideoshow')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'detail' => $detail,
                'agenda' => $agenda,
                'populer' => $populer,

            ]
        );
    }
}
