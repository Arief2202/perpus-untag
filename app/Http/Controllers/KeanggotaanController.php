<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeanggotaanRequest;
use App\Http\Requests\UpdateKeanggotaanRequest;
use App\Models\Keanggotaan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeanggotaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function readKeanggotaanView(Request $request)
    {
        return view('dashboard.keanggotaan.daftar-keanggotaan.read', [
            'keanggotaans' => Keanggotaan::all(),
        ]);
    }

    public function createKeanggotaanView(Request $request)
    {
        return view('dashboard.keanggotaan.daftar-keanggotaan.create');
    }

    public function updateKeanggotaanView($id, Request $request)
    {
        return view('dashboard.keanggotaan.daftar-keanggotaan.update',[
            'keanggotaan' => keanggotaan::where('id', $id)->first(),
        ]);
    }

    public function createKeanggotaan(Request $request){
        
        $keanggotaan = new Keanggotaan();
        $keanggotaan->nama_keanggotaan = $request->nama_keanggotaan;
        $keanggotaan->max_pinjam = $request->max_pinjam;
        $keanggotaan->masa_aktif_pinjam = $request->masa_aktif_pinjam;
        $keanggotaan->denda_per_hari = $request->denda_per_hari;
        $keanggotaan->save();
        return redirect('/dashboard/keanggotaan/daftar-keanggotaan');
    }

    public function deleteKeanggotaan(Request $request)
    {
        Keanggotaan::where('id', $request->id)->first()->delete();
        return redirect('/dashboard/keanggotaan/daftar-keanggotaan');
    }

    public function updateKeanggotaan(Request $request)
    {
        $keanggotaan = Keanggotaan::where('id', $request->id)->first();
        $keanggotaan->nama_keanggotaan = $request->nama_keanggotaan;
        $keanggotaan->max_pinjam = $request->max_pinjam;
        $keanggotaan->masa_aktif_pinjam = $request->masa_aktif_pinjam;
        $keanggotaan->denda_per_hari = $request->denda_per_hari;
        $keanggotaan->save();
        return redirect('/dashboard/keanggotaan/daftar-keanggotaan');
    }


    public function readAkunView(Request $request)
    {
        return view('dashboard.keanggotaan.daftar-akun.read', [
            'users' => User::all(),
        ]);
    }

    public function createAkunView(Request $request)
    {
        return view('dashboard.keanggotaan.daftar-akun.create');
    }

    public function updateAkunView($id, Request $request)
    {
        return view('dashboard.keanggotaan.daftar-akun.update');
    }

    public function createAkun(Request $request)
    {
    }

    public function deleteAkun(Request $request)
    {
    }

    public function updateAkun(Request $request)
    {
    }

}
