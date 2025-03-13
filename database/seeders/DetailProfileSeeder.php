<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('detail_profile')->insert( [
            'address' => 'Rejoso',
            'nomor_tlp' => '082233390162',
            'ttl' => '2002-10-12',
            'foto' => 'picture.png'
        ]);
    }
}
