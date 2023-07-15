<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['2020/2021', '2021/2022', '2022/2023'];
        foreach ($data as $tahun_ajaran) {
            TahunAjaran::create(['tahun_ajaran' => $tahun_ajaran]);
        }
    }
}
