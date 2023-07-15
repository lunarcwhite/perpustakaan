<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekapanPeminjaman;
use App\Models\PembayaranDenda;
use PDF;

class RekapanController extends Controller
{
    public function peminjaman_buku(Request $request)
    {
        if($request->filled('bulan')) {
            $date = explode('-',$request->bulan);
            $data['rekapans'] = RekapanPeminjaman::whereMonth('created_at', $date[1])->whereYear('created_at', $date[0])->get();
            return view('admin.rekapan.peminjaman_buku')->with($data);
        }else{
            $data['rekapans'] = RekapanPeminjaman::all();
            return view('admin.rekapan.peminjaman_buku')->with($data);
        }
    }

    public function pembayaran_denda()
    {
        $data['pembayarans'] = PembayaranDenda::all();
        return view('admin.rekapan.pembayaran_denda')->with($data);
    }

    public function print_peminjaman(Request $request)
    {
        $bulan = $request->bulan;
        $rekapans = RekapanPeminjaman::all();
        if($bulan == null) {
            $rekapans = RekapanPeminjaman::all();
            $pdf = PDF::loadview('admin.rekapan.print_peminjaman', ['rekapans' => $rekapans]);
        }else{
            $date = explode('-',$bulan);
            $rekapans = RekapanPeminjaman::whereMonth('created_at', $date[1])->whereYear('created_at', $date[0])->get();
            $pdf = PDF::loadview('admin.rekapan.print_peminjaman', ['rekapans' => $rekapans]);
        }
        return $pdf->download('rekap_peminjaman_tanggal_'.$bulan.'.pdf');
    }
}
