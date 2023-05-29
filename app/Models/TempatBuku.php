<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatBuku extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'tempat_buku_id');
    }
}
