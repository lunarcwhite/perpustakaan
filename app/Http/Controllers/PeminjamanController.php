<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\RekapanPeminjaman;
use App\Models\Buku;

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
    public function pending()
    {
        $data['peminjamans'] = Peminjaman::where('status_peminjaman', 2)->orderBy('created_at')->get();
        return view('admin.peminjaman.pending')->with($data);
    }
    public function berlangsung()
    {
        $data['peminjamans'] = Peminjaman::where('status_peminjaman', 1)->orderBy('updated_at', 'desc')->get();
        return view('admin.peminjaman.berlangsung')->with($data);
    }
    public function ditolak()
    {
        $data['peminjamans'] = Peminjaman::where('status_peminjaman', 0)->orderBy('updated_at', 'desc')->get();
        return view('admin.peminjaman.ditolak')->with($data);
    }
    public function selesai(Request $request, $id)
    {
        $status = $request->status_peminjaman;
        $data_pinjam = Peminjaman::where('id', $id)->first();
        try {
            $data = [
                'user_id' => $data_pinjam->user_id,
                'buku_id' => $data_pinjam->buku_id,
                'tanggal_mulai_peminjaman' => date('Y-m-d'),
                'durasi_peminjaman' => $data_pinjam->durasi_peminjaman,
                'tanggal_pengembalian' => date('Y-m-d')
            ];
            RekapanPeminjaman::create($data);
            $data_pinjam->delete();
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
            'tanggal_mulai_peminjaman' => 'required',
            'durasi_peminjaman' => 'required|integer'
        ]);

        $data['tanggal_mulai_peminjaman'] = $request->tanggal_mulai_peminjaman;
        $data['durasi_peminjaman'] = $request->durasi_peminjaman;
        $data['user_id'] = auth()->user()->id;
        $data['buku_id'] = $request->buku_id;
        $data['tanggal_pengajuan_peminjaman'] = date('Y-m-d');
        $data['status_peminjaman'] = 2;
        if($data['tanggal_mulai_peminjaman'] < date('Y-m-d')){

            return redirect()
            ->back()
            ->with($this->notifikasi('error','Tanggal Pengajuan Tidak Bisa Kurang Dari Tanggal Hari Ini'));
        }else if(auth()->user()->role_id == 1){
            return redirect()
            ->back()
            ->with($this->notifikasi('error', 'Akun Admin Tidak Dapat '));
        }
        try {
            $peminjaman = new Peminjaman;
            $peminjaman::create($data);
            return redirect()
            ->back()
            ->with($this->notifikasi('success', 'Pengajuan Peminjaman Berhasil Dibuat'));
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->with($this->notifikasi('error',$th->getMessage()));
        }
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
