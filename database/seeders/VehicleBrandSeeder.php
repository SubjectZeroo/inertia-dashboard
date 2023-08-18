<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicle_brands')->insert([
            [
                'name' => 'BOBCAT'
            ],
            [
                'name' => 'CATERPILLAR'
            ],
            [
                'name' => 'TOYOTA'
            ],
            [
                'name' => 'DOOSAN'
            ],
            [
                'name' => 'MITSUBISHI'
            ],
            [
                'name' => 'MEGALIFT'
            ],
            [
                'name' => 'ANDINO'
            ],
            [
                'name' => 'NISSAN'
            ],
            [
                'name' => 'CLARK'
            ],
            [
                'name' => 'YALE'
            ],
            [
                'name' => 'HELI'
            ],
            [
                'name' => 'HYSTER'
            ],
            [
                'name' => 'CROWN'
            ],
            [
                'name' => 'TCM'
            ],
            [
                'name' => 'PRAMAC'
            ],
            [
                'name' => 'NEW HOLLAND'
            ],
            [
                'name' => 'HANGCHA'
            ],
            [
                'name' => 'CHINA STAKER'
            ],
            [
                'name' => 'POLIF'
            ],
            [
                'name' => 'KOMATSU'
            ],
            [
                'name' => 'ALLICE CHALMERS'
            ],
            [
                'name' => 'MARIOTTI'
            ],
            [
                'name' => 'JAC'
            ],
            [
                'name' => 'MOFFET'
            ],
            [
                'name' => 'EP'
            ],
            [
                'name' => 'DAEWOO'
            ],
            [
                'name' => 'PRESTO'
            ],
            [
                'name' => 'GOOD SENSE'
            ],
            [
                'name' => 'ISUZU'
            ],
            [
                'name' => 'STILL'
            ],
            [
                'name' => 'GC POWER'
            ],
            [
                'name' => 'UTILEV'
            ],
            [
                'name' => 'FLEXI'
            ],
            [
                'name' => 'JLG'
            ],
            [
                'name' => 'CUSHMAN'
            ],
            [
                'name' => 'HAYTER'
            ],
            [
                'name' => 'BT'
            ],
            [
                'name' => 'RAYMOND'
            ],
            [
                'name' => 'JUNGHEINRICH'
            ],
            [
                'name' => 'POWER LIFT'
            ]
         ]);
    }
}
