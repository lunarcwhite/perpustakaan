<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use App\Models\Anggota;
use App\Models\PembayaranDenda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dendas'] = Denda::all();
        $data['anggotas'] = Anggota::where('denda', '>', 0)->orderBy('nama_anggota')->get();
        return view('admin.denda.index')->with($data);
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
        $request->validate([
            'nilai_denda' => 'required',
            'keterangan_denda' => 'required'
        ]);

        try {
            Denda::create([
                'denda' => $request->nilai_denda,
                'keterangan' => $request->keterangan_denda
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Pembuatan denda gagal!');
            // return redirect()->back()->withErrors($th->getMessage());

        }
        $notif = [
            'alert-type' => 'success',
            'message' => 'Pembuatan denda berhasil!'
        ];
        return redirect()->back()->with($notif);
    }

    public function bayar(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'pembayaran_denda' => 'required',
            'keterangan_pembayaran' => 'required'
        ]);

        try {
            $denda = $request->denda_anggota;
            $bayar = $request->pembayaran_denda;
            if($bayar > $denda){
                return redirect()->back()->withErrors('Pembayaran melebihi total denda');
            }

            $mayar = $denda - $bayar;
            Anggota::where('id', $request->id)->update([
                'denda' => $mayar
            ]);
            PembayaranDenda::create([
                'anggota_id' => $request->id,
                'pembayaran_denda' => $bayar,
                'keterangan' => $request->keterangan_pembayaran
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Pembayaran denda gagal!');
            // return redirect()->back()->withErrors($th->getMessage());

        }
        $notif = [
            'alert-type' => 'success',
            'message' => 'Pembayaran denda berhasil!'
        ];
        return redirect()->back()->with($notif);
    }

    /**
     * Display the specified resource.
     */
    public function show(Denda $denda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Denda $denda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $denda)
    {
        $request->validate([
            'denda' => 'required'
        ]);
        try {
            Denda::where('id', $denda)->update([
                'denda' => $request->denda
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Gagal memperbarui nilai denda!');
        }
        $notif = [
            'alert-type' => 'success',
            'message' => 'Berhasil memperbarui nilai denda'
        ];
        return redirect()->back()->with($notif);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Denda $denda)
    {
        //
    }
}
