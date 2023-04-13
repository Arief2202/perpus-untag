<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Http\Request;
use App\Models\Buku;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Illuminate\Support\Str;

use \Milon\Barcode\DNS2D;
// use Milon\Barcode\Facades\DNS2DFacade\DNS2D;
// use Milon\Barcode\DNS2D;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

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
    
    public function read(Request $request)
    {
        $buku = null;
        if(isset($request->id)) $buku = Buku::where("id", $request->id)->first();
        return view('dashboard.pengolahan.buku',[
            "bukus" => Buku::all(),
            "detail_buku" => $buku
        ]);
    }

    public function update(Request $request)
    {
        $cariBuku = Buku::where("id", $request->id)->first();
        if($cariBuku){
            $cariBuku->label=$request->label;
            $cariBuku->judul=$request->judul;
            $cariBuku->pengarang=$request->pengarang;
            $cariBuku->impresium=$request->impresium;
            $cariBuku->kolasi=$request->kolasi;
            $cariBuku->isbn_issn=$request->isbn_issn;
            $cariBuku->jumlah=$request->jumlah;
            $cariBuku->save();
        } 
        return redirect('/dashboard/pengolahan/buku');
    }

    public function delete(Request $request)
    {
        $cariBuku = Buku::where("id", $request->id)->first();
        if($cariBuku) $cariBuku->delete();
        return redirect('/dashboard/pengolahan/buku');
    }

}
