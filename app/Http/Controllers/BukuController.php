<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function read()
    {
        return view('dashboard.pengolahan.buku',[
            "bukus" => Buku::all(),
        ]);
    }

    public function create(Request $request)
    {
        $cariBuku = Buku::where("label", $request->label)->first();
        if($cariBuku) return redirect('/dashboard/pengolahan/buku');
        else {
            $newBuku = new Buku();
            $newBuku->label = $request->label;
            $newBuku->judul = $request->judul;
            $newBuku->pengarang = $request->pengarang;
            $newBuku->impresium = $request->impresium;
            $newBuku->kolasi = $request->kolasi;
            $newBuku->isbn_issn = $request->isbn_issn;
            $newBuku->jumlah = $request->jumlah;
            $newBuku->save();
            return redirect('/dashboard/pengolahan/buku');
        }
    }

    public function delete(Request $request)
    {
        $cariBuku = Buku::where("id", $request->id)->first();
        if($cariBuku) $cariBuku->delete();
        return redirect('/dashboard/pengolahan/buku');
    }

}
