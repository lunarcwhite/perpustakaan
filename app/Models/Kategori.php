<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sarana()
    {
        return $this->hasMany(SaranaPrasarana::class, 'kategori_id', 'id');
    }
}
