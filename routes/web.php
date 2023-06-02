<?php
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Illuminate\Support\Str;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangeSidebarController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\SirkulasiController;
use App\Http\Controllers\KeanggotaanController;
use App\Http\Controllers\BukuController;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/changeDarkMode', [ChangeSidebarController::class, 'changeDarkMode']); 
Route::post('/changeSideBarState', [ChangeSidebarController::class, 'changeSideBarOpen']); 

Route::get('/', function () {
    return view('landing');
});

// Route::get('/dashboard/pengolahan/buku/showQR/{label}', function($label){
//     return response(view('components.printBarcode', [
//         "label" => $label,
//     ]), 200);
// });


Route::get('/sirkulasi/mandiri/login', function(){
    if(Auth::user()) return redirect('/sirkulasi/mandiri/select');
    return view('sirkulasi.login');
});
Route::get('/sirkulasi/mandiri/select', function(){
    if(!Auth::user()) return redirect('/sirkulasi/mandiri/login');
    return view('sirkulasi.select');
});

Route::middleware('auth')->group(function() {
    Route::controller(PeminjamanController::class)->group(function(){
        Route::post('/sirkulasi/mandiri/peminjaman/checkout', 'checkout');
        Route::post('/sirkulasi/mandiri/peminjaman/add', 'addOrder');
        Route::post('/sirkulasi/mandiri/peminjaman/delete', 'deleteOrder');
        Route::get('/sirkulasi/mandiri/peminjaman', 'index')->name('sirkulasi.peminjaman');
        Route::get('/sirkulasi/mandiri/peminjaman/nota', 'nota');
    });
    Route::controller(PengembalianController::class)->group(function(){
        Route::post('/sirkulasi/mandiri/pengembalian/checkout', 'checkout');
        Route::post('/sirkulasi/mandiri/pengembalian/add', 'addOrder');
        Route::post('/sirkulasi/mandiri/pengembalian/delete', 'deleteOrder');
        Route::get('/sirkulasi/mandiri/pengembalian', 'index')->name('sirkulasi.pengembalian');
        Route::get('/sirkulasi/mandiri/pengembalian/nota', 'nota');
    });

    Route::controller(BukuController::class)->group(function(){
        Route::get('/dashboard/pengolahan/buku', 'read');
        Route::get('/dashboard/pengolahan/buku/update/{id}', 'updateView');
        Route::get('/dashboard/pengolahan/buku/add', 'createForm');
        Route::post('/dashboard/pengolahan/buku/create', 'create');
        Route::post('/dashboard/pengolahan/buku/delete', 'delete');
        Route::post('/dashboard/pengolahan/buku/update', 'update');

        Route::get('/dashboard/pengolahan/cetak-label', 'cetak_label');
        Route::post('/dashboard/pengolahan/cetak-label', 'cetak_label_print');
    });
    Route::controller(KeanggotaanController::class)->group(function(){
        Route::get('/dashboard/keanggotaan/daftar-keanggotaan', 'readKeanggotaanView');
        Route::get('/dashboard/keanggotaan/daftar-keanggotaan/create', 'createKeanggotaanView');
        Route::get('/dashboard/keanggotaan/daftar-keanggotaan/update/{id}', 'updateKeanggotaanView');
        Route::post('/dashboard/keanggotaan/daftar-keanggotaan/create', 'createKeanggotaan');
        Route::post('/dashboard/keanggotaan/daftar-keanggotaan/delete', 'deleteKeanggotaan');
        Route::post('/dashboard/keanggotaan/daftar-keanggotaan/update', 'updateKeanggotaan');
        
        Route::get('/dashboard/keanggotaan/daftar-akun', 'readAkunView');
        Route::get('/dashboard/keanggotaan/daftar-akun/create', 'createAkunView');
        Route::get('/dashboard/keanggotaan/daftar-akun/update/{id}', 'updateAkunView');
        Route::post('/dashboard/keanggotaan/daftar-akun/create', 'createAkun');
        Route::post('/dashboard/keanggotaan/daftar-akun/delete', 'deleteAkun');
        Route::post('/dashboard/keanggotaan/daftar-akun/update', 'updateAkun');
    });
    
    Route::controller(SirkulasiController::class)->group(function(){
        Route::get('/dashboard/user/peminjaman-terkini', 'userPeminjamanTerkini');
        Route::get('/dashboard/user/history-peminjaman', 'userHistoryPeminjaman');

        Route::get('/dashboard/sirkulasi/aktif', 'adminPeminjamanTerkini');
        Route::get('/dashboard/sirkulasi/history', 'adminHistoryPeminjaman');
    
    });

    Route::controller(ProfileController::class)->group(function(){
        Route::get('/dashboard/user/account', 'userReadAccountView');

        Route::get('/dashboard/keanggotaan/daftar-akun', 'adminReadAccountView');
        Route::get('/dashboard/keanggotaan/daftar-akun/create', 'adminCreateAccountView');
        Route::get('/dashboard/keanggotaan/daftar-akun/edit/{id}', 'adminUpdateAccountView');
        Route::post('/dashboard/keanggotaan/daftar-akun/create', 'adminCreateAccount');
        Route::post('/dashboard/keanggotaan/daftar-akun/edit/{id}', 'adminUpdateAccountView');
        Route::post('/dashboard/keanggotaan/daftar-akun/update', 'adminUpdateAccount');
        Route::post('/dashboard/keanggotaan/daftar-akun/delete', 'adminDeleteAccount');

        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    
});

Route::get('/dashboard', function () {
    if(Auth::user()->keanggotaan_id == 2) return redirect('/dashboard/pengolahan/buku');
    else if(Auth::user()->keanggotaan_id == 1) return redirect('/dashboard/keanggotaan/daftar-akun');
    else return redirect('/dashboard/user/peminjaman-terkini');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::any('/dashboard/{any}', function(){
    return view('dashboard.example');
})->where('any', '.*');

Route::any('/sirkulasi{any}', function(){
    return redirect('/sirkulasi/mandiri/login');
})->where('any', '.*');


Route::view('/', 'landing');

Route::view('/profil/fasilitas', 'profil.fasilitas');
Route::view('/profil/badan-perpustakaan-untag-surabaya', 'profil.badan-perpus');
Route::view('/profil/struktur-organisasi', 'profil.struktur');
Route::view('/profil/visi-misi', 'profil.visi-misi');

Route::view('/informasi/pengumuman', 'informasi.pengumuman');
Route::view('/informasi/berita', 'informasi.berita');
Route::view('/informasi/keanggotaan', 'informasi.keanggotaan');
Route::view('/informasi/jam-operasional', 'informasi.jam-operasional');
Route::view('/informasi/layanan', 'informasi.layanan');
Route::view('/informasi/kerjasama', 'informasi.kerjasama');

Route::view('/prosedur/layanan-fotocopy-skripsi', 'prosedur.layanan-fotocopy-skripsi');
Route::view('/prosedur/alur-kerja-proses-buku', 'prosedur.alur-kerja-proses-buku');
Route::view('/prosedur/prosedur-pemesanan-buku', 'prosedur.prosedur-pemesanan-buku');
Route::view('/prosedur/prosedur-pengembalian-buku', 'prosedur.prosedur-pengembalian-buku');
Route::view('/prosedur/prosedur-peminjaman-buku', 'prosedur.prosedur-peminjaman-buku');

Route::view('/akses-informasi', 'akses-informasi');
Route::view('/unduhan', 'unduhan');
Route::view('/kontak', 'kontak');

require __DIR__.'/auth.php';
