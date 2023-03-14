<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/testbarcode', function(){
    echo DNS2D::getBarcodeHTML('Hello World', 'QRCODE');
    echo '<br><br><br>';
    
    echo '<img src="data:image/png;base64,' . DNS2D::getBarcodePNG('Hello World', 'QRCODE', 10, 10) . '" alt="barcode"   />';
    echo '<br><br><br>';

    echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('HELLO WORLD', 'C39', 2,100) . '" alt="barcode"   />';
    echo '<br><br><br>';
    
    echo '
    <a href="data:image/png;base64,' . DNS1D::getBarcodePNG('HELLO WORLD', 'C39', 2,100) . '" download="'.'HELLO WORLD'.'.png">
        <img src="data:image/png;base64,' . DNS1D::getBarcodePNG('HELLO WORLD', 'C39', 2,100) . '" alt="embedded folder icon"/>
    </a>
    ';
});

require __DIR__.'/auth.php';
