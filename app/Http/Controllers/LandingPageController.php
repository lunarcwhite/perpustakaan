<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        $data['kategoris'] = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data['queryKategori'] = $request->kategori;
        $data['queryKeyword'] = $request->keyword;
        if($request->filled('kategori')) {
            $kategori = Kategori::where('nama_kategori', $request->kategori)->first();
            $data['bukus'] = Buku::where('kategori_id', $kategori->id)->orderBy('nama_buku','asc')->paginate(10);
        }elseif($request->filled('keyword') && $request->keyword != ''){
            $data['bukus'] = Buku::where('nama_buku','LIKE', "%$request->keyword%")->orderBy('nama_buku','asc')->paginate(10);
        }else{
            $data['bukus'] = Buku::orderBy('nama_buku','asc')->paginate(10);
        }
        return view('landing_page.index')->with($data);
    }
}
