<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function tempat_buku()
    {
        return $this->belongsTo(TempatBuku::class, 'tempat_buku_id');
    }
    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class, 'buku_id');
    }
}
