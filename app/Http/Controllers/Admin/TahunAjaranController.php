<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['tahunAjarans'] = TahunAjaran::all();
        return view('admin.tahunAjaran.index')->with($data);
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
            'tahun_ajaran' => 'required|unique:tahun_ajarans,tahun_ajaran',
        ]);
        try {
            TahunAjaran::create($request->all());
            $notification = [
                'alert-type' => 'success',
                'message' => 'Tahun Ajaran Berhasil Ditambahkan',
            ];
            return redirect()
            ->back()
            ->with($notification);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()
            ->back()
            ->withErrors('Gagal menambahkan tahun ajaran!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAjaran $tahunAjaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        return $tahunAjaran;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $tahunAjaran)
    {
        $validate = $request->validate([
            'tahun_ajaran' => 'required|unique:tahun_ajarans,tahun_ajaran',
        ]);
        try {
            TahunAjaran::where('id', $tahunAjaran)->update([
                'tahun_ajaran' => $request->tahun_ajaran
            ]);
            $notification = [
                'alert-type' => 'success',
                'message' => 'Tahun Ajaran Berhasil Diperbarui',
            ];
            return redirect()
            ->back()
            ->with($notification);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return redirect()
            ->back()
            ->withErrors('Gagal memperbarui tahun ajaran!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        //
    }
}
