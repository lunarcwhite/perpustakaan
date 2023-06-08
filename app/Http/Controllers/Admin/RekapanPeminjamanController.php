<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekapanPeminjaman;
use PDF;

class RekapanPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        if($request->filled('bulan')) {
            $date = explode('-',$request->bulan);
            $data['rekapans'] = RekapanPeminjaman::whereMonth('created_at', $date[1])->whereYear('created_at', $date[0])->get();
            return view('admin.rekapan_peminjaman.index')->with($data);
        }else{
            $data['rekapans'] = RekapanPeminjaman::all();
            return view('admin.rekapan_peminjaman.index')->with($data);
        }
    }
    public function print(Request $request)
    {
        $bulan = $request->bulan;
        $rekapans = RekapanPeminjaman::all();
        if($bulan == null) {
            $rekapans = RekapanPeminjaman::all();
            $pdf = PDF::loadview('admin.rekapan_peminjaman.print', ['rekapans' => $rekapans]);
        }else{
            $date = explode('-',$bulan);
            $rekapans = RekapanPeminjaman::whereMonth('created_at', $date[1])->whereYear('created_at', $date[0])->get();
            $pdf = PDF::loadview('admin.rekapan_peminjaman.print', ['rekapans' => $rekapans]);
        }
        return $pdf->download('rekap_peminjaman_tanggal_'.$bulan.'.pdf');
    }
}
