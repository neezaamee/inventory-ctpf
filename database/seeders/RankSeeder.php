<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rank;

class RankSeeder extends Seeder
{
    public function run(): void
    {
        $ranks = [
            'Constable',
            'Head Constable',
            'ASI (Assistant Sub-Inspector)',
            'Sub-Inspector',
            'Inspector',
            'DSP (Deputy Superintendent of Police)',
            'SP (Superintendent of Police)',
            'SSP (Senior Superintendent of Police)',
            'CPO (City Police Officer)',
            'DIG (Deputy Inspector General)',
            'IGP (Inspector General of Police)',
            'Civilian / Warder',
        ];

        foreach ($ranks as $rank) {
            Rank::firstOrCreate(['name' => $rank]);
        }
    }
}
