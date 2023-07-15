<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekapanPeminjaman;
use Auth;
use App\Models\Peminjaman;
use App\Models\PembayaranDenda;
use App\Models\Denda;


class RiwayatController extends Controller
{
    protected $id_user;
    protected $id_anggota;

    public function __construct()
    {
        return $this->id_user = Auth::user();
    }

    public function getAnggota()
    {
        return $this->id_anggota = Anggota::where('user_id', $this->id_user)->first();
    }

    public function peminjaman()
    {
        $data['riwayats'] = RekapanPeminjaman::where('anggota_id', $this->id_anggota)->get();
        return view('user.riwayat.riwayat_peminjaman')->with($data);
    }

    public function peminjaman_aktif()
    {
        $data['peminjamans'] = Peminjaman::where('anggota_id', $this->id_anggota)->get();
        return view('user.riwayat.peminjaman_aktif')->with($data);
    }

    public function pembayaran_denda()
    {
        $data['pembayaran_dendas'] = PembayaranDenda::where('anggota_id', $this->id_anggota)->get();
        $data['dendas'] = Denda::all();
        return view('user.riwayat.pembayaran_denda')->with($data);
    }
}
