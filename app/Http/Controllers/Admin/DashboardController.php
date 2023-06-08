<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Kategori;
use App\Models\Buku;
use App\Models\RekapanPeminjaman;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $data['kategoris'] = Kategori::all();
        $data['bukus'] = Buku::all();
        $data['rekapans'] = RekapanPeminjaman::whereDate('created_at', date('Y-m-d'));
        $data['pendings'] = Peminjaman::where('status_peminjaman', 2)->get();
        return view('admin.dashboard.index')->with($data);
    }
}
