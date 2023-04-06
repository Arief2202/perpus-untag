<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangeSidebarController;

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

Route::get('/dashboard', function () {
    return view('dashboard.dashboard.index', [
        // 'errorMessage' => "Test"
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/dashboard/{sub}', 'dashboard.example');
Route::view('/dashboard/{sub}/{sub2}', 'dashboard.example');

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/testbarcode', function(){
//     echo DNS2D::getBarcodeHTML('Hello World', 'QRCODE');
//     echo '<br><br><br>';
    
//     echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('Hello World', 'QRCODE', 10, 10) . '" alt="barcode"   />';
//     echo '<br><br><br>';

//     echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('HELLO WORLD', 'C39', 2,100) . '" alt="barcode"   />';
//     echo '<br><br><br>';
    
//     echo '
//     <a href="data:image/png;base64,' . DNS1D::getBarcodePNG('HELLO WORLD', 'C39', 2,100) . '" download="'.'HELLO WORLD'.'.png">
//         <img src="data:image/png;base64,' . DNS1D::getBarcodePNG('HELLO WORLD', 'C39', 2,100) . '" alt="embedded folder icon"/>
//     </a>
//     ';
// });

require __DIR__.'/auth.php';
