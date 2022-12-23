<?php

namespace App\Http\Controllers;

use App\Models\AgendaModel;
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
use Cabor;
use Validator;
use Image;
use DB;
use Carbon\Carbon;
use DataTables;

class DepanController extends Controller
{
    public function index()
    {
        $profil = ProfilModel::first();
        $slider = SliderModel::get();
        $title = 'Home - ' . $profil->nama;

        //count data depan
        $kcabor = DB::table('tb_cabor')
            ->select('id')->count();
        $kclub = DB::table('tb_club')
            ->select('id')->count();
        $kpelatih = DB::table('tb_pelatih')
            ->select('id')->count();
        $katlit = DB::table('tb_atlit')
            ->select('id')->count();

        // kata sambutan
        $sambutan = DB::table('tb_sambutan')
            ->join('tb_pengurus', 'tb_sambutan.id_pengurus', '=', 'tb_pengurus.id')
            ->select('tb_sambutan.id as ids', 'tb_sambutan.isi as katasambutan', 'tb_pengurus.nama as namap', 'tb_pengurus.foto as fotop', 'tb_pengurus.jabatan as jabatanp')
            ->first();

        // visi misi
        $visimisi = DB::table('tb_visimisi')
            ->select('tb_visimisi.id as id', 'tb_visimisi.visi as visi', 'tb_visimisi.misi as misi')
            ->first();



        $berita = BeritaModel::join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->select(['tb_berita.*', 'tb_beritakat.nama as kategoriberita'])
            ->orderBy('tb_berita.tgl_berita', 'desc')->take(6)->get();

        $galerifoto = FotoKontenModel::take(3)->get();

        foreach ($galerifoto as $datak) {
            $galfoto = FotoModel::where('id_galeri', $datak->id)->first();
            $tgloke =  Carbon::parse($datak->tgl)->isoFormat('D MMMM Y');
            $res[] = [
                'id' => $datak->id,
                'judul' => $datak->judul,
                'slug' => $datak->id_galkat,
                'isi' => $datak->isi,
                'fotogal' => $galfoto->foto,
                'tgl' => $tgloke,
            ];
        };

        $hasilgal = json_decode(json_encode($res), FALSE);

        $galerivideo = VideoModel::take(3)->get();

        // sidebar kanan
        $agenda = AgendaModel::take(5)->get();

        $populer = BeritaModel::orderBy('visitor', 'DESC')->take(5)->get();



        return view('beranda')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'slider' => $slider,
                'kcabor' => $kcabor,
                'kclub' => $kclub,
                'kpelatih' => $kpelatih,
                'katlit' => $katlit,
                'sambutan' => $sambutan,
                'visimisi' => $visimisi,
                'berita' => $berita,
                'hasilgal' => $hasilgal,
                'galvideo' => $galerivideo,
                'agenda' => $agenda,
                'populer' => $populer,
            ]
        );
    }

    public function berita(Request $request)
    {
        $profil = ProfilModel::first();
        $title = 'Berita - ' . $profil->nama;

        $berita = BeritaModel::join('tb_beritakat', 'tb_berita.id_katberita', '=', 'tb_beritakat.id')
            ->select(['tb_berita.*', 'tb_beritakat.nama as kategoriberita'])
            ->orderBy('tb_berita.tgl_berita', 'desc')->get();

        // dd($berita);

        return view('berita')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'berita' => $berita,
            ]
        );
    }

    public function galerifoto(Request $request)
    {
        $profil = ProfilModel::first();
        $title = 'Galeri Foto - ' . $profil->nama;

        $galerifoto = FotoKontenModel::get();

        foreach ($galerifoto as $datak) {
            $galfoto = FotoModel::where('id_galeri', $datak->id)->first();
            $tgloke =  Carbon::parse($datak->tgl)->isoFormat('D MMMM Y');
            $res[] = [
                'id' => $datak->id,
                'judul' => $datak->judul,
                'slug' => $datak->id_galkat,
                'isi' => $datak->isi,
                'fotogal' => $galfoto->foto,
                'tgl' => $tgloke,
            ];
        };

        $hasilgal = json_decode(json_encode($res), FALSE);


        // dd($berita);

        return view('galerifoto')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'galerifoto' => $hasilgal,
            ]
        );
    }

    public function galerivideo(Request $request)
    {
        $profil = ProfilModel::first();
        $title = 'Galeri Video - ' . $profil->nama;


        $galerivideo = VideoModel::take(3)->get();


        // dd($berita);

        return view('galerivideo')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'galerivideo' => $galerivideo,
            ]
        );
    }

    public function profil()
    {
        $profil = ProfilModel::first();
        $title = 'Profil - ' . $profil->nama;



        return view('profil')->with(
            [
                'title' => $title,
                'profil' => $profil,

            ]
        );
    }

    public function proker()
    {
        $profil = ProfilModel::first();
        $title = 'Program Kerja - ' . $profil->nama;
        $data = ProkerModel::select('judul', 'isi')->first();


        return view('proker')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'proker' => $data,

            ]
        );
    }

    public function visimisi()
    {
        $profil = ProfilModel::first();
        $title = 'Visi dan Misi - ' . $profil->nama;
        $data = DB::table('tb_visimisi')->select('visi', 'misi')->first();


        return view('visimisi')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'visimisi' => $data,

            ]
        );
    }

    public function tupoksi()
    {
        $profil = ProfilModel::first();
        $title = 'Tupoksi - ' . $profil->nama;
        $data = DB::table('tb_kat_pengurus')->select('nama_kat', 'tupoksi')->get();


        return view('tupoksi')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'tupoksi' => $data,

            ]
        );
    }
    public function struktur()
    {
        $profil = ProfilModel::first();
        $title = 'Struktur Organisasi - ' . $profil->nama;
        $data = DB::table('tb_struktur')->select('judul', 'foto')->first();


        return view('struktur')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'struktur' => $data,

            ]
        );
    }

    public function pengurus()
    {
        $profil = ProfilModel::first();
        $title = 'Pengurus - ' . $profil->nama;
        $data = DB::table('tb_pengurus')
            ->join('tb_kat_pengurus', 'tb_pengurus.id_kat_peng', '=', 'tb_kat_pengurus.id')
            ->select('tb_pengurus.*', 'tb_kat_pengurus.nama_kat as jenispengurus',)
            ->get();


        return view('pengurus')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'pengurus' => $data,

            ]
        );
    }

    public function cabor(Request $request)

    {
        $profil = ProfilModel::first();
        $induk = DB::table('indukorganisasi')->get();

        $title = 'Cabor';



        return view('cabor')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'induk' => $induk,
            ]
        );
    }

    public function get_custom_posts(Request $request)
    {

        $postsQuery =  DB::table('tb_cabor')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id');


        if ($_GET["status_induk"] == '') {
            $status_induk = $_GET['status_induk'];
            $postsQuery;
        } else {
            $status_induk = $_GET['status_induk'];
            $postsQuery->whereRaw("tb_cabor.id_induk = '" . $status_induk . "' ");
        }

        $posts = $postsQuery->select('tb_cabor.*', 'indukorganisasi.panjang as indukp', 'indukorganisasi.pendek as indukpendek');
        return datatables()->of($posts)->addIndexColumn()->addColumn('action', function ($posts) {
            $btn = '<a href="detaildata" class="text-info"></a>';
            return $btn;
        })->escapeColumns('action')
            ->addColumn('logo', function ($posts) {
                $url = asset('berkas/cabor/thumbnail/' . $posts->logo);
                $btn = '<img src="' . $url . '" style="width:80px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="cabor/opendetail/' .  $posts->id . '" class="edit btn btn-info btn-sm text-white"><i class="fa fa-info-circle"></i> Detail</a>';
                return $btn;
            })->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('tb_cabor.cabor', 'LIKE', "%$search%")
                            ->orWhere('indukorganisasi.panjang', 'LIKE', "%$search%");
                    });
                }
            })->rawColumns(['action', 'logo'])->make(true);
    }

    public function club(Request $request)

    {
        $profil = ProfilModel::first();
        $cabor = DB::table('tb_cabor')->get();

        $title = 'Club';


        return view('club')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'cabor' => $cabor,
            ]
        );
    }

    public function get_club(Request $request)
    {

        $postsQuery =  DB::table('tb_club')
            ->join('tb_cabor', 'tb_club.id_cabor', '=', 'tb_cabor.id');


        if ($_GET["status_induk"] == '') {
            $status_induk = $_GET['status_induk'];
            $postsQuery;
        } else {
            $status_induk = $_GET['status_induk'];
            $postsQuery->whereRaw("tb_club.id_cabor = '" . $status_induk . "' ");
        }

        $posts = $postsQuery->select('tb_club.*', 'tb_cabor.cabor as namacabor');
        return datatables()->of($posts)->addIndexColumn()->addColumn('action', function ($posts) {
            $btn = '<a href="detaildata" class="text-info"></a>';
            return $btn;
        })->escapeColumns('action')
            ->addColumn('logo', function ($posts) {
                $url = asset('berkas/club/thumbnail/' . $posts->logo);
                $btn = '<img src="' . $url . '" style="width:80px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="' . url('/induk-organisasi/club/opendetail', $posts->id) . '")" class="edit btn btn-info btn-sm text-white"><i class="fa fa-info-circle"></i> Detail</a>';
                return $btn;
            })->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('tb_club.club', 'LIKE', "%$search%")
                            ->orWhere('tb_cabor.cabor', 'LIKE', "%$search%");
                    });
                }
            })->rawColumns(['action', 'logo'])->make(true);
    }

    public function pelatih(Request $request)

    {
        $profil = ProfilModel::first();
        $cabor = DB::table('tb_cabor')->get();

        $title = 'Pelatih';


        return view('pelatih')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'cabor' => $cabor,
            ]
        );
    }

    public function fetchClub(Request $request)
    {
        $data['states'] = ClubModel::where("id_cabor", $request->kec_id)->get(["club", "id"]);
        return response()->json($data);
    }

    public function get_pelatih(Request $request)
    {



        $postsQuery = DB::table('tb_pelatih')
            ->join('tb_cabor', 'tb_pelatih.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_pelatih.id_club', '=', 'tb_club.id');


        if ($_GET["status_cabor"] == '' && $_GET["status_club"] == '') {

            $postsQuery;
        } else if ($_GET["status_cabor"] != '' && $_GET["status_club"] == '') {
            $status_cabor = $_GET['status_cabor'];
            $postsQuery->whereRaw("tb_pelatih.id_cabor = '" . $status_cabor . "' ");
        } else if ($_GET["status_cabor"] != '' && $_GET["status_club"] != '') {
            $status_cabor = $_GET['status_cabor'];
            $status_club = $_GET['status_club'];
            $postsQuery->whereRaw("tb_pelatih.id_cabor = '" . $status_cabor . "' and tb_pelatih.id_club = '" . $status_club . "' ");
        }

        $posts = $postsQuery->select('tb_pelatih.*', 'tb_cabor.cabor as namacabor',  'tb_club.club as namaclub',);
        return datatables()->of($posts)->addIndexColumn()->addColumn('action', function ($posts) {
            $btn = '<a href="detaildata" class="text-info"></a>';
            return $btn;
        })->escapeColumns('action')
            ->addColumn('foto', function ($posts) {
                $url = asset('berkas/pelatih/thumbnail/' . $posts->foto);
                $btn = '<img src="' . $url . '" style="width:80px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="' . url('/induk-organisasi/pelatih/opendetail', $posts->id) . '" class="edit btn btn-info btn-sm text-white"><i class="fa fa-info-circle"></i> Detail</a>';
                return $btn;
            })->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('tb_club.club', 'LIKE', "%$search%")
                            ->orWhere('tb_cabor.cabor', 'LIKE', "%$search%")
                            ->orWhere('tb_pelatih.nama', 'LIKE', "%$search%");
                    });
                }
            })->rawColumns(['action', 'foto'])->make(true);
    }

    // atlit
    public function atlit(Request $request)

    {
        $profil = ProfilModel::first();
        $cabor = DB::table('tb_cabor')->get();

        $title = 'Atlit';


        return view('atlit')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'cabor' => $cabor,
            ]
        );
    }
    public function fetchAtlit(Request $request)
    {
        $data['cities'] = PelatihModel::where("id_club", $request->state_id)->get(["nama", "id"]);
        return response()->json($data);
    }

    public function get_atlit(Request $request)
    {



        $postsQuery = DB::table('tb_atlit')
            ->join('tb_cabor', 'tb_atlit.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_atlit.id_club', '=', 'tb_club.id');



        if ($_GET["status_cabor"] == '' && $_GET["status_club"] == '') {

            $postsQuery;
        } else if ($_GET["status_cabor"] != '' && $_GET["status_club"] == '') {
            $status_cabor = $_GET['status_cabor'];
            $postsQuery->whereRaw("tb_atlit.id_cabor = '" . $status_cabor . "' ");
        } else if ($_GET["status_cabor"] != '' && $_GET["status_club"] != '') {
            $status_cabor = $_GET['status_cabor'];
            $status_club = $_GET['status_club'];
            $postsQuery->whereRaw("tb_atlit.id_cabor = '" . $status_cabor . "' and tb_atlit.id_club = '" . $status_club . "' ");
        }

        $posts = $postsQuery->select('tb_atlit.*', 'tb_cabor.cabor as cabor', 'tb_club.club as club',);
        return datatables()->of($posts)->addIndexColumn()->addColumn('action', function ($posts) {
            $btn = '<a href="detaildata" class="text-info"></a>';
            return $btn;
        })->escapeColumns('action')
            ->addColumn('foto', function ($posts) {
                $url = asset('berkas/atlet/thumbnail/' . $posts->foto);
                $btn = '<img src="' . $url . '" style="width:80px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="' . url('/induk-organisasi/atlit/opendetail', $posts->id) . '" class="edit btn btn-info btn-sm text-white"><i class="fa fa-info-circle"></i> Detail</a>';
                return $btn;
            })->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('tb_club.club', 'LIKE', "%$search%")
                            ->orWhere('tb_cabor.cabor', 'LIKE', "%$search%")
                            ->orWhere('tb_atlit.nama', 'LIKE', "%$search%");
                    });
                }
            })->rawColumns(['action', 'foto'])->make(true);
    }

    // atlit
    public function wasit(Request $request)

    {
        $profil = ProfilModel::first();
        $title = 'Wasit';


        return view('wasit')->with(
            [
                'title' => $title,
                'profil' => $profil,

            ]
        );
    }

    public function get_wasit(Request $request)
    {

        $postsQuery = DB::table('tb_wasit');

        $posts = $postsQuery->select('tb_wasit.*',);
        return datatables()->of($posts)->addIndexColumn()->addColumn('action', function ($posts) {
            $btn = '<a href="detaildata" class="text-info"></a>';
            return $btn;
        })->escapeColumns('action')
            ->addColumn('foto', function ($posts) {
                $url = asset('berkas/wasit/thumbnail/' . $posts->foto);
                $btn = '<img src="' . $url . '" style="width:80px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm text-white"><i class="fa fa-info-circle"></i> Detail</a>';
                return $btn;
            })->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('tb_wasit.nama', 'LIKE', "%$search%");
                    });
                }
            })->rawColumns(['action', 'foto'])->make(true);
    }


    // untuk detail 
    public function cabordetail($id)

    {
        $profil = ProfilModel::first();
        $induk = DB::table('indukorganisasi')->get();


        $title = 'Cabor Detail';


        $detail = DB::table('tb_cabor')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_cabor.*', 'indukorganisasi.panjang as indukp', 'indukorganisasi.pendek as indukpendek')
            ->where('tb_cabor.id', $id)->first();

        $tclub = DB::table('tb_club')
            ->select('id')->where('id_cabor', $id)->count();
        $tpelatih = DB::table('tb_pelatih')
            ->select('id')->where('id_cabor', $id)->count();
        $tatlit = DB::table('tb_atlit')
            ->select('id')->where('id_cabor', $id)->count();


        $club = DB::table('tb_club')->select('id', 'id_cabor', 'club')
            ->where('id_cabor', $id)->get();

        if ($detail == null) {
            return abort(404);
        }

        return view('caborshow')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'induk' => $induk,
                'club' => $club,
                'detail' => $detail,
                'tclub' => $tclub,
                'tpelatih' => $tpelatih,
                'tatlit' => $tatlit,
            ]
        );
    }

    public function clubdetail($id)

    {
        $profil = ProfilModel::first();
        $induk = DB::table('indukorganisasi')->get();


        $title = 'Club Detail';


        $detail = DB::table('tb_club')
            ->join('tb_cabor', 'tb_club.id_cabor', '=', 'tb_cabor.id')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_club.*', 'tb_cabor.cabor as namacabor', 'tb_cabor.id as idcabor', 'indukorganisasi.panjang as indukp', 'indukorganisasi.pendek as indukpendek')
            ->where('tb_club.id', $id)->first();




        $tpelatih = DB::table('tb_pelatih')
            ->select('id')->where('id_club', $id)->count();
        $tatlit = DB::table('tb_atlit')
            ->select('id')->where('id_club', $id)->count();


        $club = DB::table('tb_club')->select('id', 'id_cabor', 'club')
            ->where('id_cabor', $id)->get();

        if ($detail == null) {
            return abort(404);
        }

        return view('clubshow')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'induk' => $induk,
                'club' => $club,
                'detail' => $detail,

                'tpelatih' => $tpelatih,
                'tatlit' => $tatlit,
            ]
        );
    }

    public function pelatihdetail($id)

    {
        $profil = ProfilModel::first();

        $title = 'Pelatih Detail';


        $detail = DB::table('tb_pelatih')
            ->join('tb_cabor', 'tb_pelatih.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_pelatih.id_club', '=', 'tb_club.id')
            ->join('indukorganisasi', 'tb_cabor.id_induk', '=', 'indukorganisasi.id')
            ->select('tb_pelatih.*', 'tb_cabor.cabor as namacabor', 'tb_cabor.id as idcabor', 'tb_club.id as idclub',  'tb_club.club as namaclub', 'tb_club.alamat as alamatclub', 'indukorganisasi.panjang as indukp', 'indukorganisasi.pendek as indukpendek')
            ->where('tb_pelatih.id', $id)->first();
        $tanggalLahir = $detail->tgl_lahir;
        $usia = Carbon::parse($tanggalLahir)->age;


        $tatlit = DB::table('tb_atlit')
            ->select('id')->where('id_club', $detail->id_club)->count();


        $club = DB::table('tb_club')->select('id', 'id_cabor', 'club')
            ->where('id_cabor', $id)->get();

        if ($detail == null) {
            return abort(404);
        }

        return view('pelatihshow')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'usia' => $usia,
                'club' => $club,
                'detail' => $detail,


                'tatlit' => $tatlit,
            ]
        );
    }

    public function atlitdetail($id)

    {
        $profil = ProfilModel::first();

        $title = 'Atlit Detail';


        $detail = DB::table('tb_atlit')
            ->join('tb_cabor', 'tb_atlit.id_cabor', '=', 'tb_cabor.id')
            ->join('tb_club', 'tb_atlit.id_club', '=', 'tb_club.id')
            ->join('tb_kecamatan', 'tb_atlit.kecamatan', '=', 'tb_kecamatan.id')
            ->join('tb_kelurahan', 'tb_atlit.kelurahan', '=', 'tb_kelurahan.id')
            ->select('tb_atlit.*', 'tb_cabor.cabor as cabor', 'tb_club.club as club', 'tb_kecamatan.kecamatan as camat', 'tb_kelurahan.kelurahan as lurah')
            ->where('tb_atlit.id', $id)->first();

        $prestasi = DB::table('tb_prestasi')
            ->join('tb_atlit', 'tb_prestasi.id_atlet', '=', 'tb_atlit.id')
            ->join('tb_juara', 'tb_prestasi.kejuaraan', '=', 'tb_juara.id')
            ->join('tb_medali', 'tb_prestasi.medali', '=', 'tb_medali.id')
            ->select('tb_prestasi.*', 'tb_juara.nama as kejur', 'tb_medali.medali as medal',)
            ->where('tb_atlit.id', $id)->get();



        $tanggalLahir = $detail->tgl_lahir;
        $usia = Carbon::parse($tanggalLahir)->age;


        if ($detail == null) {
            return abort(404);
        }

        return view('atlitshow')->with(
            [
                'title' => $title,
                'profil' => $profil,
                'usia' => $usia,

                'detail' => $detail,
                'prestasi' => $prestasi,
            ]
        );
    }
}
