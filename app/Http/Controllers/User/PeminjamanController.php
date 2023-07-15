<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\RekapanPeminjaman;
use App\Models\Buku;
use App\Models\Anggota;

class PeminjamanController extends Controller
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'durasi_peminjaman' => 'required|integer'
        ]);

        $id_user = auth()->user()->id;
        $durasi = $request->durasi_peminjaman;
        $anggota = Anggota::where('user_id', $id_user)->first();
        $tanggalSekarang = date('Y-m-d');
        $id_buku = $request->buku_id;
        $buku = Buku::where('id', $id_buku)->first();
        $tanggalPengembalian = date('Y-m-d', strtotime($tanggalSekarang . ' +'.$durasi.' days'));
        // dd($tanggalPengembalian);
        $data['buku_id'] = $id_buku;
        $data['tanggal_mulai_peminjaman'] = $tanggalSekarang;
        $data['status_peminjaman'] = 1;
        $data['anggota_id'] = $anggota->id;
        $data['durasi_peminjaman'] = $durasi;
        $data['tanggal_pengembalian'] = $tanggalPengembalian;
        if($anggota->denda > 0){
            return redirect()
            ->back()
            ->withErrors('Tidak Dapat Meminjam. Anda Masih Memiliki Denda Yang Belum Dibayar!');
        }else if(auth()->user()->role_id == 1){
            return redirect()
            ->back()
            ->withErrors('Akun Admin Tidak Dapat ');
        }elseif($durasi > 7){
            return redirect()
            ->back()
            ->withErrors('Durasi Peminjaman Tidak Dapat Lebih Dari 7 Hari!');
        }elseif($buku->status_tersedia == 0){
            $peminjam = $buku->peminjaman->anggota->nama_anggota;
            return redirect()
            ->back()
            ->withErrors('Buku Sedang Dipinjam Oleh ' . $peminjam);
        }
        try {
            Buku::where('id', $id_buku)->update([
                'status_tersedia' => 0
            ]);
            $peminjaman = new Peminjaman;
            $peminjaman::create($data);
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->withErrors('Gagal meminjam buku!');
        }
        return redirect()
        ->back()
        ->with($this->notifikasi('success', 'Peminjaman Berhasil Dibuat. Buku Dapat Diambil Diperpustakaan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $peminjaman = Peminjaman::where('id', $id)->first();
        $status = $request->status_peminjaman;
        try {
            $peminjaman->where('id', $id)->update([
                'status_peminjaman' => $status,
                'keterangan' => $request->keterangan
            ]);
            if($status == 1){
                Buku::where('id', $peminjaman->buku_id)->update([
                    'status_tersedia' => 0  
                ]);
            }
            return redirect()
            ->back()
            ->with($this->notifikasi('success','Aksi Berhasil Dilakukan'));
            
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->with($this->notifikasi('error',$th->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Peminjaman::where('id', $id)->delete();
            return redirect()
            ->back()
            ->with($this->notifikasi('success','Aksi Berhasil Dilakukan'));
            
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->with($this->notifikasi('error',$th->getMessage()));
        }
    }
}
