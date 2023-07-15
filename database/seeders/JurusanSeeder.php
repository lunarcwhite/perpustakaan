<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['TKJ','Perawat', 'OTKP', 'Perhotelan', 'Farmasi', 'Jasa Boga', 'Elektro'];
        foreach ($data as $key => $value) {
            Jurusan::create(['nama_jurusan' => $value]);
        }
    }
}
