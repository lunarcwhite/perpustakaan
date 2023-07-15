<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as faker;

class customer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 15; $i++) { 
            DB::table('customer')->insert([
                'nama_customer' => $faker->randomElement(['Ayu', 'Dimas', 'Bima',]),
                'domisili' => $faker->randomElement(['cianjur', 'bandung', 'jakarta', 'bogor']),
                'usia' => $faker->randomElement([20, 21, 22, 25]),
            ]);
        }
    }
}
