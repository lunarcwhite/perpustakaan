<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\TempatBuku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 15; $i++) { 
            $kategori = Kategori::inRandomOrder()->pluck('id')->first();
            $tempat_buku = TempatBuku::inRandomOrder()->pluck('id')->first();
            Buku::create([
                'nama_buku' => 'buku'.$i+1,
                'kategori_id' => $kategori,
                'tempat_buku_id' => $tempat_buku,
            ]);
        }
    }
}
