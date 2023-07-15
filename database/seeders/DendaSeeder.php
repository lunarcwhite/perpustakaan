<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Denda;

class DendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Denda::create([
            'id' => 1,
            'denda' => 0,
            'keterangan' => 'Denda Telat Pengembalian Perhari'
        ]);
    }
}
