<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as faker;

class campaign extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 15; $i++) { 
            DB::table('campaign')->insert([
                'budget_campaign' => $faker->randomElement([10000000, 15000000, 20000000]),
                'start_campaign' => $faker->randomElement(['2020-01-01', '2020-02-01']),
                'end_campaign' => $faker->randomElement(['2021-02-01', '2021-01-01']),
                'tipe_campaign' => 'campaign-'.$i+1,
            ]);
        }
    }
}
