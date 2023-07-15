<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TempatBuku;

class TempatBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 11; $i++) { 
            $data = [
                'nama_tempat_buku' => 'Tempat Buku-'.$i
            ];
            TempatBuku::create($data);
        }
    }
}
