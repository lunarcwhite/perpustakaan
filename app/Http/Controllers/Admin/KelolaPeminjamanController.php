<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\RekapanPeminjaman;
use App\Models\Denda;
use App\Models\PembayaranDenda;
use App\Models\Buku;
use App\Models\Anggota;

class KelolaPeminjamanController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function notifikasi($type, $message)
    {
        return [
            'alert-type' => $type,
            'message' => $message
        ];
    }
    public function index()
    {
        $data['peminjamans'] = Peminjaman::orderBy('created_at')->get();
        $data['denda'] = Denda::pluck('denda')->first();
        return view('admin.peminjaman.index')->with($data);
    }
    public function selesai(Request $request)
    {
        $request->validate([
           'bayar_denda' => 'required',
           'keterangan' => 'required'
        ]);
        $id_peminjaman = $request->id_peminjaman;
        $bayar = $request->bayar_denda;
        $denda = $request->denda;
        $data_pinjam = Peminjaman::where('id', $id_peminjaman)->first();
        // dd($data_pinjam);
        try {
            $rekapanPeminjaman = [
                'anggota_id' => $data_pinjam->anggota_id,
                'buku_id' => $data_pinjam->buku_id,
                'tanggal_mulai_peminjaman' => $data_pinjam->tanggal_mulai_peminjaman,
                'tanggal_pengembalian' => date('Y-m-d')
            ];
            RekapanPeminjaman::create($rekapanPeminjaman);
            if($bayar > $denda){
                return redirect()->back()->withErrors('Pembayaran denda melebihi total denda');
            }elseif($bayar > 0){
                if($denda - $bayar > 0){
                    $anggota = Anggota::where('id', $data_pinjam->anggota_id)->first();
                    Anggota::where('id', $data_pinjam->anggota_id)->update([
                        'denda' => $anggota->denda + ($denda - $bayar),
                    ]);
                }
                $bayarDenda = [
                    'anggota_id' => $data_pinjam->anggota_id,
                    'pembayaran_denda' => $bayar,
                    'keterangan' => $request->keterangan
                ];
                PembayaranDenda::create($bayarDenda);
            }
            Buku::where('id', $data_pinjam->buku_id)->update([
                'status_tersedia' => 1
            ]);
            Peminjaman::where('id', $id_peminjaman)->delete();
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->withErrors($th->getMessage());
        }
        return redirect()
            ->back()
            ->with($this->notifikasi('success','Aksi Berhasil Dilakukan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(String $peminjaman)
    {
        return Peminjaman::with('buku')->with('anggota')->where('id', $peminjaman)->first();

    }

}
