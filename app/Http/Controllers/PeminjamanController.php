<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()) return redirect('/sirkulasi/mandiri/login');
        return view('sirkulasi.peminjaman',[
            'peminjamans' => Peminjaman::where('user_id', Auth::user()->id)->where('status', 0)->get(),
            'active_peminjamans' => Peminjaman::where('user_id', Auth::user()->id)->where('status', '>=', 1)->where('status', '<=', 2)->get(),
        ]);
    }

    public function addOrder(Request $request)
    {
        $jumlahDipinjam = Peminjaman::where('user_id', $request->user_id)->where('status', '<', 3)->get()->count();
        $limitPinjamUser = User::where('id', $request->user_id)->first()->keanggotaan->max_pinjam;
        if($jumlahDipinjam >= $limitPinjamUser) return Redirect::route('sirkulasi.peminjaman')->with('error', true)->with('message', "Data Gagal Ditambahkan, anda telah melebihi limit peminjaman");

        $flagFound = false;
        foreach(Peminjaman::where('user_id', $request->user_id)->where('status', '<', 2)->get() as $peminjaman){
            if($peminjaman->copy_number == $request->label){
                $flagFound = true;
                break;
            }
        }
        if($flagFound) return Redirect::route('sirkulasi.peminjaman')->with('error', true)->with('message', "Data Gagal Ditambahkan, anda telah meminjam label ini");
        foreach(Peminjaman::where('status', '<', 2)->get() as $peminjaman){
            if($peminjaman->copy_number == $request->label){
                $flagFound = true;
                break;
            }
        }        
        if($flagFound) return Redirect::route('sirkulasi.peminjaman')->with('error', true)->with('message', "Data Gagal Ditambahkan, Label ini telah dipinjam oleh user lain");
        foreach(Buku::all() as $buku){
            for($a = 0; $a < $buku->jumlah; $a++){                   
                $label = $buku->prefix . sprintf("%0".$buku->length_code."d", $a+1);
                if($request->label == $label){
                    Peminjaman::insert([
                        'user_id' => $request->user_id,
                        'buku_id' => $buku->id,
                        'copy_number' => $label,
                        'status' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    return Redirect::route('sirkulasi.peminjaman')->with('error', false)->with('message', "Data Berhasil Ditambahkan");
                }
            }
        }        
        return Redirect::route('sirkulasi.peminjaman')->with('error', true)->with('message', "Data Gagal Ditambahkan, QR Tidak ditemukan di database");
    }

    public function deleteOrder(Request $request)
    {
        Peminjaman::where('id', $request->id)->first()->delete();
        return redirect('/sirkulasi/mandiri/peminjaman');
    }
    
    public function checkout(Request $request)
    {
        foreach(Peminjaman::where('user_id', Auth::user()->id)->where('status', 0)->get() as $peminjaman){
            $peminjaman->status = 1;
            $peminjaman->save();
        }
        return redirect('/sirkulasi/mandiri/peminjaman');
    }

    public function nota(Request $request)
    {
        return view('components.notaPeminjaman', [
            'items' => Peminjaman::where('user_id', Auth::user()->id)->where('status', 0)->get()
        ]);
    }
}
