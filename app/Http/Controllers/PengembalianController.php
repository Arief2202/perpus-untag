<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        if(!Auth::user()) return redirect('/sirkulasi/mandiri/login');
        return view('sirkulasi.pengembalian',[
            'peminjamans' => Peminjaman::where('user_id', Auth::user()->id)->where('status', 2)->get(),
            'active_peminjamans' => Peminjaman::where('user_id', Auth::user()->id)->where('status', '>=', 1)->where('status', '<=', 2)->get(),
        ]);
    }

    public function addOrder(Request $request)
    {
        $pengembalian = Peminjaman::where('user_id', Auth::user()->id)->where('status', 1)->where('copy_number', $request->label)->first();
        if($pengembalian){
            $pengembalian->status = 2;
            $pengembalian->save();
            return Redirect::route('sirkulasi.pengembalian')->with('error', false)->with('message', "Data Berhasil Ditambahkan");
        }
        else{
            $pengembalian = Peminjaman::where('user_id', Auth::user()->id)->where('status', 2)->where('copy_number', $request->label)->first();
            if($pengembalian && $pengembalian->status) return Redirect::route('sirkulasi.pengembalian')->with('error', true)->with('message', "Data Gagal Ditambahkan, Anda Sudah menambahnya di keranjang");
            return Redirect::route('sirkulasi.pengembalian')->with('error', true)->with('message', "Data Gagal Ditambahkan, Anda tidak meminjam koleksi dengan label tersebut");
        }
    }

    public function deleteOrder(Request $request){
        $pengembalian = Peminjaman::where('id', $request->id)->first();
        $pengembalian->status = 1;
        $pengembalian->save();
        return redirect('/sirkulasi/mandiri/pengembalian');
    }
    
    public function checkout(Request $request)
    {
        foreach(Peminjaman::where('user_id', Auth::user()->id)->where('status', 2)->get() as $peminjaman){
            $peminjaman->status = 3;
            $peminjaman->save();
        }
        return redirect('/sirkulasi/mandiri/pengembalian');
    }
    public function nota(Request $request)
    {
        return view('components.notaPengembalian', [
            'items' => Peminjaman::where('user_id', Auth::user()->id)->where('status', 2)->get()
        ]);
    }

}
