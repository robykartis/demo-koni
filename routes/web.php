<?php

use App\Http\Controllers\Admin\AgendaControler;
use App\Http\Controllers\Admin\AkunControler;
use App\Http\Controllers\Admin\AkunPenggunaControler;
use App\Http\Controllers\Admin\AtlitController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\BeritaKatController;
use App\Http\Controllers\Admin\CaborController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\DataTabelControler;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\GalfotController;
use App\Http\Controllers\Admin\IndukOrganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// ADMIN CONTROLER
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\ProkerController;
use App\Http\Controllers\Admin\StrukturController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\KatPengController;
use App\Http\Controllers\Admin\PelatihController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\SambutanController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VideoControler;
use App\Http\Controllers\Admin\WasitController;
use App\Http\Controllers\DepanController;
use App\Http\Controllers\BeritaPublikController;
use App\Http\Controllers\Cabor\CakunControler;
use App\Http\Controllers\Cabor\CatlitControler;
use App\Http\Controllers\Cabor\CberitaControler;
// cabor
use App\Http\Controllers\Cabor\CclubControler;
use App\Http\Controllers\Cabor\CpelatihControler;
use App\Http\Controllers\Cabor\CwasitControler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Untuk Public
Route::get('/', [DepanController::class, 'index']);
Route::get('/berita', [DepanController::class, 'berita']);

Route::get('/galeri-foto', [DepanController::class, 'galerifoto']);
Route::get('/galeri-video', [DepanController::class, 'galerivideo']);

Route::get('/tentang-kami/profil', [DepanController::class, 'profil']);
Route::get('/tentang-kami/program-kerja', [DepanController::class, 'proker']);
Route::get('/tentang-kami/visi-misi', [DepanController::class, 'visimisi']);
Route::get('/tentang-kami/tupoksi', [DepanController::class, 'tupoksi']);
Route::get('/tentang-kami/struktur-organisasi', [DepanController::class, 'struktur']);
Route::get('/tentang-kami/pengurus', [DepanController::class, 'pengurus']);

Route::get('/induk-organisasi/cabang-olahraga', [DepanController::class, 'cabor']);
Route::get('jsoncabor', [DepanController::class, 'get_custom_posts']);

Route::get('/induk-organisasi/club', [DepanController::class, 'club']);
Route::get('jsonclub', [DepanController::class, 'get_club']);

// pelatih
Route::get('/induk-organisasi/pelatih', [DepanController::class, 'pelatih']);
Route::post('api-club', [DepanController::class, 'fetchClub']);
Route::get('jsonpelatih', [DepanController::class, 'get_pelatih']);

// atlit
Route::get('/induk-organisasi/atlit', [DepanController::class, 'atlit']);
Route::post('api-atlit', [DepanController::class, 'fetchAtlit']);
Route::get('jsonatlit', [DepanController::class, 'get_atlit']);

// atlit
Route::get('/induk-organisasi/wasit', [DepanController::class, 'wasit']);
Route::get('jsonwasit', [DepanController::class, 'get_wasit']);


//cabor detail 
Route::get('/induk-organisasi/cabor/opendetail/{id}', [DepanController::class, 'cabordetail']);
Route::get('/induk-organisasi/club/opendetail/{id}', [DepanController::class, 'clubdetail']);
Route::get('/induk-organisasi/pelatih/opendetail/{id}', [DepanController::class, 'pelatihdetail']);
Route::get('/induk-organisasi/atlit/opendetail/{id}', [DepanController::class, 'atlitdetail']);

// detail berita
Route::get('/berita/detail/{slug}', [BeritaPublikController::class, 'beritashow']);
// galeri foto
Route::get('/galeri-foto/detail/{slug}', [BeritaPublikController::class, 'galerifotoshow']);
// galeri video
Route::get('/galeri-video/detail/{slug}', [BeritaPublikController::class, 'galerivideoshow']);

// Untuk MIdleware
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::middleware(['is_admin'])->group(function () {

        Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
        //profil koni
        Route::resource('admin/profil', ProfilController::class);
        Route::post('admin/updateprofil', [ProfilController::class, 'updatedata']);
        // proker
        Route::resource('admin/proker', ProkerController::class);
        Route::post('admin/updateproker', [ProkerController::class, 'updatedata']);
        // visimisi
        Route::resource('admin/visimisi', VisiMisiController::class);
        Route::post('admin/updatevisimisi', [VisiMisiController::class, 'updatedata']);
        // struktur organisasi
        Route::resource('admin/struktur', StrukturController::class);
        Route::post('admin/updatestruktur', [StrukturController::class, 'updatedata']);
        // kategori pengurus
        Route::resource('admin/katpeng', KatPengController::class);
        Route::post('admin/updatekatpeng', [KatPengController::class, 'updatedata']);

        //  pengurus
        Route::resource('admin/pengurus', PengurusController::class);
        Route::post('admin/updatepengurus', [PengurusController::class, 'updatedata']);
        //  induk organisasi
        Route::resource('admin/indukorganisasi', IndukOrganController::class);
        Route::post('admin/updateindukorganisasi', [IndukOrganController::class, 'updatedata']);
        //  induk cabor
        Route::resource('admin/cabor', CaborController::class);
        Route::post('admin/updatecabor', [CaborController::class, 'updatedata']);
        //  induk club
        Route::resource('admin/club', ClubController::class);
        Route::post('admin/updateclub', [ClubController::class, 'updatedata']);
        //  induk atlit
        Route::resource('admin/atlit', AtlitController::class);
        Route::post('admin/updateatlit', [AtlitController::class, 'updatedata']);
        Route::post('admin/api/fetch-cities', [AtlitController::class, 'fetchCity']);
        Route::post('admin/api/fetch-club', [AtlitController::class, 'fetchClub']);
        Route::post('admin/ubahprestasi', [AtlitController::class, 'ubahprestasi']);
        Route::get('admin/preshapus/{id}', [AtlitController::class, 'preshapus']);
        Route::post('admin/simpanpres', [AtlitController::class, 'simpanpres']);

        //  pelatih
        Route::resource('admin/pelatih', PelatihController::class);
        Route::post('admin/updatepelatih', [PelatihController::class, 'updatedata']);

        //  wasit
        Route::resource('admin/wasit', WasitController::class);
        Route::post('admin/updatewasit', [WasitController::class, 'updatedata']);

        //  beritakat
        Route::resource('admin/beritakat', BeritaKatController::class);
        Route::post('admin/updateberitakat', [BeritaKatController::class, 'updatedata']);

        //  berita
        Route::resource('admin/berita', BeritaController::class);
        Route::post('admin/updateberita', [BeritaController::class, 'updatedata']);
        Route::get('admin/draftberita', [BeritaController::class, 'draftberita']);
        Route::get('admin/draftberita/detail/{id}', [BeritaController::class, 'detaildraftberita']);
        Route::post('admin/draftberita/acc', [BeritaController::class, 'accberita']);

        //  kategori agenda
        Route::resource('admin/katagenda', GalfotController::class);
        Route::post('admin/updatekatagenda', [GalfotController::class, 'updatedata']);

        //  galeri foto
        Route::resource('admin/galerifoto', GaleriController::class);
        Route::post('admin/updategalerifoto', [GaleriController::class, 'updatedata']);

        //  galeri video
        Route::resource('admin/video', VideoControler::class);
        Route::post('admin/updatevideo', [VideoControler::class, 'updatedata']);

        //
        //  slider website
        Route::resource('admin/slider', SliderController::class);
        Route::post('admin/updateslider', [SliderController::class, 'updatedata']);

        // kata sambutan
        Route::resource('admin/sambutan', SambutanController::class);
        Route::post('admin/updatesambutan', [SambutanController::class, 'updatedata']);

        // akun pengguna
        Route::resource('admin/akunpengguna', AkunPenggunaControler::class);
        Route::post('admin/updateakunp', [AkunPenggunaControler::class, 'updatedata']);

        // akun saya
        Route::resource('admin/akun', AkunControler::class);
        Route::post('admin/akun/changePassword', [AkunControler::class, 'changePasswordPost']);

        //admin data tabel
        Route::get('admin/jsonatlit', [DataTabelControler::class, 'get_atlit']);
        Route::get('admin/jsonpelatih', [DataTabelControler::class, 'get_pelatih']);
        Route::get('admin/jsonclub', [DataTabelControler::class, 'get_club']);
        Route::get('admin/club/hapus/{id}', [DataTabelControler::class, 'hapusclub']);
        Route::get('admin/pelatih/hapus/{id}', [DataTabelControler::class, 'hapuspelatih']);
        Route::get('admin/atlit/hapus/{id}', [DataTabelControler::class, 'hapusatlit']);

        //  admin agenda
        Route::resource('admin/agenda', AgendaControler::class);
        Route::post('admin/updateagenda', [AgendaControler::class, 'updatedata']);
    });



    Route::middleware(['is_cabor'])->group(function () {
        Route::get('cabor/home', [AdminController::class, 'cabor'])->name('cabor.home');

        //  cabor club
        Route::resource('cabor/cclub', CclubControler::class);
        Route::post('cabor/updatecclub', [CclubControler::class, 'updatedata']);

        // cabor pelatih
        Route::resource('cabor/cpelatih', CpelatihControler::class);
        Route::post('cabor/updatecpelatih', [CpelatihControler::class, 'updatedata']);
        Route::get('cabor/jsonpelatih', [CpelatihControler::class, 'get_pelatih']);
        Route::get('cabor/cpelatih/hapus/{id}', [CpelatihControler::class, 'hapuspel']);

        //  cabor atlit
        Route::resource('cabor/catlit', CatlitControler::class);
        Route::post('cabor/updatecatlit', [CatlitControler::class, 'updatedata']);
        Route::get('cabor/jsonatlit', [CatlitControler::class, 'get_atlit']);
        Route::post('cabor/api/fetch-cities', [CatlitControler::class, 'fetchCity']);
        Route::get('cabor/catlit/hapus/{id}', [CatlitControler::class, 'hapusat']);

        Route::post('cabor/ubahprestasi', [CatlitControler::class, 'ubahprestasi']);
        Route::get('cabor/preshapus/{id}', [CatlitControler::class, 'preshapus']);
        Route::post('cabor/simpanpres', [CatlitControler::class, 'simpanpres']);

        // cabor wasit 
        Route::resource('cabor/cwasit', CwasitControler::class);
        Route::post('cabor/updatecwasit', [CwasitControler::class, 'updatedata']);

        // cabor akun 
        Route::resource('cabor/cakun', CakunControler::class);
        Route::post('cabor/akun/changePassword', [CakunControler::class, 'changePasswordPost']);
        // seting cabor
        Route::get('cabor/aturcabor', [CakunControler::class, 'aturcabor']);
        Route::post('cabor/updatecabor', [CakunControler::class, 'updatedata']);

        //cabor berita

        Route::resource('cabor/cberita', CberitaControler::class);
        Route::post('cabor/updatecberita', [CberitaControler::class, 'updatedata']);
    });
});
