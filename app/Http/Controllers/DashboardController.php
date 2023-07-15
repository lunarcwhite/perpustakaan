<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Kategori;
use App\Models\Buku;
use App\Models\RekapanPeminjaman;
use App\Models\Peminjaman;
use App\Models\Anggota;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role_id;
        $anggota = Anggota::where('user_id', $user->id)->first();
        if($role == 1){
            $data['kategoris'] = Kategori::all();
            $data['bukus'] = Buku::all();
            $data['rekapans'] = RekapanPeminjaman::whereDate('created_at', date('Y-m-d'));
            $data['pendings'] = Peminjaman::where('status_peminjaman', 2)->get();
            return view('admin.dashboard.index')->with($data);
        }elseif($role == 2){
            $data['riwayat_peminjamans'] = RekapanPeminjaman::where('anggota_id', $anggota->id)->get();
            $data['peminjamans'] = Peminjaman::where('anggota_id', $anggota->id)->get();
            $data['anggota'] = $anggota;
            return view('user.dashboard.index')->with($data);
        }else{
            return redirect()->route('landing');
        }
    }
}
