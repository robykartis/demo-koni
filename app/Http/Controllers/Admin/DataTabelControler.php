<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaborModel;
use App\Models\IndukOrganModel;
use App\Models\AtlitModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\ClubModel;
use App\Models\PrestasiModel;
use App\Models\Juara;
use App\Models\Medali;
use App\Models\PelatihModel;
use Cabor;
use Validator;
use Image;
use DB;
use Carbon\Carbon;
use DataTables;


class DataTabelControler extends Controller
{
    public function fetchClub(Request $request)
    {
        $data['states'] = ClubModel::where("id_cabor", $request->kec_id)->get(["club", "id"]);
        return response()->json($data);
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
                $btn = '<img src="' . $url . '" style="width:40px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="' . route('club.show', $posts->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-info-square me-0"></i></a> ';
                $btn = $btn . '<a href="' . route('club.edit', $posts->id) . '" class="btn btn-info btn-sm"><i class="bx bx-edit me-0"></i></a>';
                $btn = $btn . '  <a href="' . url('admin/club/hapus', $posts->id) . '" class="btn btn-danger btn-sm"><i class="bx bx-trash me-0"></i></a>';

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

    public function hapusclub(Request $request, $id)
    {
        //fungsi eloquent untuk menghapus data
        ClubModel::find($id)->delete();


        return redirect()->route('club.index')
            ->with('message', 'Data Berhasil Dihapus');
    }

    public function hapuspelatih(Request $request, $id)
    {
        //fungsi eloquent untuk menghapus data
        PelatihModel::find($id)->delete();


        return redirect()->route('pelatih.index')
            ->with('message', 'Data Berhasil Dihapus');
    }

    public function hapusatlit(Request $request, $id)
    {
        //fungsi eloquent untuk menghapus data
        AtlitModel::find($id)->delete();


        return redirect()->route('atlit.index')
            ->with('message', 'Data Berhasil Dihapus');
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
                $btn = '<img src="' . $url . '" style="width:40px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="' . route('atlit.show', $posts->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-info-square me-0"></i></a> ';
                $btn = $btn . '<a href="' . route('atlit.edit', $posts->id) . '" class="btn btn-info btn-sm"><i class="bx bx-edit me-0"></i></a>';
                $btn = $btn . '  <a href="' . url('admin/atlit/hapus', $posts->id) . '" class="btn btn-danger btn-sm"><i class="bx bx-trash me-0"></i></a>';

                return $btn;
            })->filter(function ($instance) use ($request) {

                if (!empty($request->get('search'))) {
                    $instance->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('tb_club.club', 'LIKE', "%$search%")
                            ->orWhere('tb_cabor.cabor', 'LIKE', "%$search%")
                            ->orWhere('tb_atlit.nia', 'LIKE', "%$search%")
                            ->orWhere('tb_atlit.nama', 'LIKE', "%$search%");
                    });
                }
            })->rawColumns(['action', 'foto'])->make(true);
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
                $btn = '<img src="' . $url . '" style="width:50px" class="text-center" alt="boe93">';
                return $btn;
            })
            ->addColumn('action', function ($posts) {
                $btn = '<a href="' . route('pelatih.show', $posts->id) . '" class="btn btn-warning btn-sm"><i class="bx bx-info-square me-0"></i></a> ';


                $btn = $btn . '<a href="' . route('pelatih.edit', $posts->id) . '" class="btn btn-info btn-sm"><i class="bx bx-edit me-0"></i></a>';

                $btn = $btn . '  <a href="' . url('admin/pelatih/hapus', $posts->id) . '" class="btn btn-danger btn-sm"><i class="bx bx-trash me-0"></i></a>';



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
}
