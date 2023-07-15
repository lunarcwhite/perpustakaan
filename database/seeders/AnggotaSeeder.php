<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Anggota;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use Faker\Factory as faker;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role_id', 2)->get();
        $faker = Faker::create('id_ID');
        foreach($users as $no => $user){
            $jurusan = Jurusan::inRandomOrder()->pluck('id')->first();
            $angkatan = TahunAjaran::inRandomOrder()->pluck('id')->first();
            Anggota::create([
                'user_id' => $user->id,
                'jurusan_id' => $jurusan,
                'tahun_ajaran_id' => $angkatan,
                'no_anggota' => rand(0000000000, 9999999999),
                'nama_anggota' => $faker->name,
            ]);
        }
    }
}
