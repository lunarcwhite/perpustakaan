<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use Faker\Factory as faker;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
            $user = User::where('role_id', 2)->inRandomOrder()->pluck('id')->first();
            $buku = Buku::inRandomOrder()->pluck('id')->first();
            $data = [
                'user_id' => $user,
                'buku_id' => $buku,
                'tanggal_pengajuan_peminjaman' => date('Y-m-d'),
                'durasi_peminjaman' => $faker->randomElement([1, 2, 3, 4, 5]),
            ];
            Peminjaman::create($data);
        }
    }
}
