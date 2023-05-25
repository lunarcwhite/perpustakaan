<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Carbon\Carbon;
use Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function getBuku()
    {
        return Buku::with('kategori')->orderBy('nama_buku', 'ASC')->get();
    }
    function getOneBuku($id)
    {
        return Buku::with('kategori')->where('id', $id)->first();
    }
    function getKategori()
    {
        return Kategori::all();
    }

    public function index()
    {
        $data['bukus'] = $this->getBuku();
        $data['kategoris'] = $this->getKategori();
        return view('admin.buku.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_buku' => 'required|unique:bukus,nama_buku',
            'kategori_id' => 'required',
            'sampul_buku' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        try {
            $foto = $request->sampul_buku;
    
            if ($request->hasFile('sampul_buku')) {
                $extension = $foto->extension();
                $filename = 'sampul_buku_' . $request->nama_buku .'_' . Carbon::now() . '.' . $extension;
                $foto->storeAs('public/images/buku/', $filename);
                $fotoDb = $filename;
            } else {
                $fotoDb = null;
            }
            $data = $request->all();
            $data['sampul_buku'] = $fotoDb;
            Buku::create($data);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Berhasil Menambah Data',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'alert-type' => 'error',
                'message' => 'Gagal. Coba Ulangi',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $Buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $Buku)
    {
        return $Buku;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $Buku)
    {
        $validate = $request->validate([
            'nama_buku' => 'required',
            'kategori_id' => 'required',
            'sampul_buku' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        try {
            $foto = $request->photo;
    
            if ($request->hasFile('sampul_buku')) {
                if($Buku->sampul_buku !== null){
                    Storage::delete('public/images/buku/'.$Buku->sampul_buku);
                }
                $extension = $foto->extension();
                $filename = 'sampul_buku_' . $request->nama_buku .'_' . Carbon::now() . '.' . $extension;
                $foto->storeAs('public/images/buku/', $filename);
                $fotoDb = $filename;
                
            } else {
                $fotoDb = null;
            }
            $data = $request->all();
            $data['sampul_buku'] = $fotoDb;
            $Buku->update($data);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Berhasil Memperbarui Data',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (\Throwable $th) {
            dd( $th);
            
            $notification = [
                'alert-type' => 'error',
                'message' => 'Gagal. Coba Ulangi',
            ];
            return redirect()
                ->back()
                ->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $Buku)
    {
        try {
                
            if($Buku->sampul_buku !== null){
                Storage::delete('public/images/buku/'.$Buku->sampul_buku);
            }
            $Buku->delete();
            $notification = [
                'alert-type' => 'success',
                'message' => 'Berhasil Menghapus Data',
            ];
            return redirect()
                ->back()
                ->with($notification);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
