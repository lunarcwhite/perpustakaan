<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $guarded = [];
 
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'tahun_ajaran_id');
    } 
}
