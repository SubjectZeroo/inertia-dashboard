<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->delete();
       $states = array(
        array (

            'country_id' => 1,
            'name' => 'Amazonas',
            'full_name' => NULL,
            'code' => 'z',
        ),
        array (

            'country_id' => 1,
            'name' => 'Yaracuy',
            'full_name' => NULL,
            'code' => 'u',

        ),
        array (

            'country_id' => 1,
            'name' => 'Estado Nueva Esparta',
            'full_name' => NULL,
            'code' => 'o',
        ),
        array (

            'country_id' => 1,
            'name' => 'Trujillo',
            'full_name' => NULL,
            'code' => 't',

        ),
        array (

            'country_id' => 1,
            'name' => 'Tachira',
            'full_name' => NULL,
            'code' => 's',

        ),
        array (

            'country_id' => 1,
            'name' => 'Zulia',
            'full_name' => NULL,
            'code' => 'v',

        ),

        array (

            'country_id' => 1,
            'name' => 'Sucre',
            'full_name' => NULL,
            'code' => 'r',

        ),
        array (

            'country_id' => 1,
            'name' => 'Monagas',
            'full_name' => NULL,
            'code' => 'n',

        ),
        array (

            'country_id' => 1,
            'name' => 'Miranda',
            'full_name' => NULL,
            'code' => 'm',

        ),
        array (

            'country_id' => 1,
            'name' => 'Merida',
            'full_name' => NULL,
            'code' => 'l',

        ),
        array (

            'country_id' => 1,
            'name' => 'Dependencias Federales',
            'full_name' => NULL,
            'code' => 'w',

        ),

        array (

            'country_id' => 1,
            'name' => 'Lara',
            'full_name' => NULL,
            'code' => 'k',

        ),

        array (

            'country_id' => 1,

            'name' => 'Cojedes',
            'full_name' => NULL,
            'code' => 'h',

        ),

        array (

            'country_id' => 1,
            'name' => 'Carabobo',
            'full_name' => NULL,
            'code' => 'g',

        ),

        array (

            'country_id' => 1,
            'name' => 'Caracas',
            'full_name' => NULL,
            'code' => 'a',

        ),

        array (

            'country_id' => 1,
            'name' => 'Guarico',
            'full_name' => NULL,
            'code' => 'j',

        ),

        array (

            'country_id' => 1,
            'name' => 'Falcon',
            'full_name' => NULL,
            'code' => 'i',

        ),

        array (

            'country_id' => 1,
            'name' => 'Portuguesa',
            'full_name' => NULL,
            'code' => 'p',
        ),

        array (

            'country_id' => 1,
            'name' => 'Bolivar',
            'full_name' => NULL,
            'code' => 'f',

        ),

        array (

            'country_id' => 1,
            'name' => 'Barinas',
            'full_name' => NULL,
            'code' => 'e',

        ),

        array (

            'country_id' => 1,
            'name' => 'Anzoategui',
            'full_name' => NULL,
            'code' => 'b',
        ),

        array (

            'country_id' => 1,
            'name' => 'Apure',
            'full_name' => NULL,
            'code' => 'c',
        ),

        array (

            'country_id' => 1,
            'name' => 'Delta Amacuro',
            'full_name' => NULL,
            'code' => 'y',
        ),

        array (

            'country_id' => 1,
            'name' => 'Aragua',
            'full_name' => NULL,
            'code' => 'd',
        )
       );
       DB::table('states')->insert($states);
    }
}
