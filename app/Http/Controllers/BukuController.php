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
    public function cetak_label(Request $request){
        return view('dashboard.pengolahan.cetak',[
            "bukus" => Buku::all(),
        ]);
    }
    public function cetak_label_print(Request $request){
        return view('components.printBarcode',[
            "request" => $request,
        ]);
    }

    public function create(Request $request)
    {
        $cariBuku = Buku::where("prefix", $request->prefix)->first();
        if($cariBuku){
            return redirect()->back()->with('error', 'Prefix sudah digunakan di buku lain !');   
        }
        else {
            $newBuku = new Buku();
            $newBuku->judul = $request->judul;
            $newBuku->deskripsi = $request->deskripsi;
            $newBuku->pengarang = $request->pengarang;
            $newBuku->impresium = $request->impresium;
            $newBuku->kolasi = $request->kolasi;
            $newBuku->isbn_issn = $request->isbn_issn;
            $newBuku->no_inventaris = $request->no_inventaris;
            $newBuku->prefix = $request->prefix;
            $newBuku->length_code = $request->length_code;
            $newBuku->jumlah = $request->jumlah;
            $newBuku->bahasa = $request->bahasa;
            $newBuku->prodi = $request->prodi;
            $newBuku->lokasi = $request->lokasi;
            $newBuku->save();
            return redirect('/dashboard/pengolahan/buku');
        }
    }

    public function createForm(Request $request)
    {
        return view('dashboard.pengolahan.create');
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
    
    public function updateView($id, Request $request)
    {
        $buku = Buku::where("id", $request->id)->first();
        return view('dashboard.pengolahan.update',[
            "buku" => $buku
        ]);
    }

    public function update(Request $request)
    {
        $cariBuku = Buku::where("id", $request->id)->first();
        if($cariBuku){
            if($request->judul)$cariBuku->judul=$request->judul;
            if($request->deskripsi)$cariBuku->deskripsi=$request->deskripsi;
            if($request->pengarang)$cariBuku->pengarang=$request->pengarang;
            if($request->impresium)$cariBuku->impresium=$request->impresium;
            if($request->kolasi)$cariBuku->kolasi=$request->kolasi;
            if($request->isbn_issn)$cariBuku->isbn_issn=$request->isbn_issn;
            if($request->no_inventaris)$cariBuku->no_inventaris=$request->no_inventaris;
            if($request->prefix)$cariBuku->prefix=$request->prefix;
            if($request->length_code)$cariBuku->length_code=$request->length_code;
            if($request->jumlah)$cariBuku->jumlah=$request->jumlah;
            if($request->bahasa)$cariBuku->bahasa=$request->bahasa;
            if($request->prodi)$cariBuku->prodi=$request->prodi;
            if($request->lokasi)$cariBuku->lokasi=$request->lokasi;
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
