<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function amggota()
    {
        return $this->hasMany(Siswa::class, 'jurusan_id');
    }
}
