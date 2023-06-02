<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class SirkulasiController extends Controller
{

    public function userPeminjamanTerkini(Request $request)
    {
        $peminjamans = Peminjaman::where('user_id', Auth::user()->id)->where('status', '>=', 1)->where('status', '<=', 2)->get();
        return view('dashboard.sirkulasi.userActive', [
            'title1' => 'Peminjaman Terkini',
            'title2' => '',
            'peminjamans' => $peminjamans,
        ]);
    }
    public function userHistoryPeminjaman(Request $request)
    {

        $peminjamans = Peminjaman::where('user_id', Auth::user()->id)->where('status', '>=', 1)->orderBy('status', 'ASC')->get();
        return view('dashboard.sirkulasi.userHistory', [
            'title1' => 'History Peminjaman',
            'title2' => '',
            'peminjamans' => $peminjamans,
        ]);
    }

    public function adminPeminjamanTerkini(Request $request)
    {
        $peminjamans = Peminjaman::where('status', '>=', 1)->where('status', '<=', 2)->get();
        return view('dashboard.sirkulasi.adminActive', [
            'title1' => 'Peminjaman Terkini',
            'title2' => '',
            'peminjamans' => $peminjamans,
        ]);
    }
    public function adminHistoryPeminjaman(Request $request)
    {

        $peminjamans = Peminjaman::where('status', '>=', 1)->orderBy('status', 'ASC')->get();
        return view('dashboard.sirkulasi.adminHistory', [
            'title1' => 'History Peminjaman',
            'title2' => '',
            'peminjamans' => $peminjamans,
        ]);
    }



}
