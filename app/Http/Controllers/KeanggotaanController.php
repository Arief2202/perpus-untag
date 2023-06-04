<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeanggotaanRequest;
use App\Http\Requests\UpdateKeanggotaanRequest;
use App\Models\AdminActivity;
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
        if(Auth::user()->keanggotaan_id == 1) $keanggotaan = Keanggotaan::all();
        else if(Auth::user()->keanggotaan_id == 2) $keanggotaan = Keanggotaan::where('id', '!=', 1)->where('id', '!=', 2)->get();
        return view('dashboard.keanggotaan.daftar-keanggotaan.read', [
            'keanggotaans' => $keanggotaan
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
        AdminActivity::insert([
            'user_id' => Auth::user()->id,
            'aksi' =>  'Create',
            'halaman' =>  'Keanggotaan',
            'table_id' =>  $keanggotaan->id,
            'data_json' =>  json_encode($keanggotaan->toArray()),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        return redirect('/dashboard/keanggotaan/daftar-keanggotaan');
    }

    public function deleteKeanggotaan(Request $request)
    {
        $keanggotaan = Keanggotaan::where('id', $request->id)->first();
        
        AdminActivity::insert([
            'user_id' => Auth::user()->id,
            'aksi' =>  'Delete',
            'halaman' =>  'Keanggotaan',
            'table_id' =>  $keanggotaan->id,
            'data_json' =>  json_encode($keanggotaan->toArray()),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        $keanggotaan->delete();
        
        return redirect('/dashboard/keanggotaan/daftar-keanggotaan');
    }

    public function updateKeanggotaan(Request $request)
    {
        $keanggotaan = Keanggotaan::where('id', $request->id)->first();
        $old = $keanggotaan->toArray();
        $keanggotaan->nama_keanggotaan = $request->nama_keanggotaan;
        $keanggotaan->max_pinjam = $request->max_pinjam;
        $keanggotaan->masa_aktif_pinjam = $request->masa_aktif_pinjam;
        $keanggotaan->denda_per_hari = $request->denda_per_hari;
        $keanggotaan->save();
        AdminActivity::insert([
            'user_id' => Auth::user()->id,
            'aksi' =>  'Update',
            'halaman' =>  'Keanggotaan',
            'table_id' =>  $keanggotaan->id,
            'data_json' =>  json_encode($old),
            'new_data_json' =>  json_encode($keanggotaan->toArray()),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        return redirect('/dashboard/keanggotaan/daftar-keanggotaan');
    }


    public function readAkunView(Request $request)
    {
        return view('dashboard.keanggotaan.daftar-akun.read', [
            'users' => User::all(),
        ]);
    }

}
