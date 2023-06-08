<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempatBuku;
use Illuminate\Http\Request;

class TempatBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tempat_bukus'] = TempatBuku::all();
        return view('admin.tempat_buku.index')->with($data);
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
            'nama_tempat_buku' => 'required'
        ]);
        $data = $request->all();
        try {
            TempatBuku::create($data);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Tempat Buku Berhasil Ditambah'
            ];
            return redirect()
            ->back()
            ->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'alert-type' => 'error',
                'message' => $th->getMessage()
            ];
            return redirect()
            ->back()
            ->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TempatBuku $tempatBuku)
    {
        $data['tempat_buku'] = TempatBuku::where('id', $tempatBuku->id)->first();
        return view('admin.tempat_buku.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TempatBuku $tempatBuku)
    {
        return $tempatBuku;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TempatBuku $tempatBuku)
    {
        $validate = $request->validate([
            'nama_tempat_buku' => 'required'
        ]);
        $data = $request->only('nama_tempat_buku');
        try {
            TempatBuku::where('id',$tempatBuku->id)->update($data);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Tempat Buku Berhasil Diperbarui'
            ];
        } catch (\Throwable $th) {
            $notification = [
                'alert-type' => 'error',
                'message' => $th->getMessage()
            ];
            return redirect()
            ->back()
            ->with($notification);
        }
        return redirect()
        ->back()
        ->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TempatBuku $tempatBuku)
    {
        try {
            $tempatBuku->where('id', $tempatBuku->id)->delete();
            $notification = [
                'alert-type' => 'success',
                'message' => 'Tempat Buku Berhasil Dihapus'
            ];
            return redirect()
            ->back()
            ->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'alert-type' => 'error',
                'message' => $th->getMessage()
            ];
            return redirect()
            ->back()
            ->with($notification);
        }
    }
}
