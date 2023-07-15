<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as faker;

class transaksi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 15; $i++) { 
            DB::table('transaksi')->insert([
                'nama_customer' => $faker->randomElement(['Ayu', 'Dimas', 'Bima',]),
                'nama_sales' => $faker->randomElement(['Jinja', 'Blade', 'Angular']),
                'nilai_transaksi' => $faker->randomElement([10000, 20000, 40000, 50000]),
                'tgl_transaksi' => $faker->randomElement(['2023-10-10', '2023-10-11', '2023-10-11']),
            ]);
        }
    }
}
