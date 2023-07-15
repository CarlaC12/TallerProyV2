<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\DenverEscala;

class denverEscalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        denverescala::create([
            'etiqueta' => 'Presente',
            'abreviatura' => 'P'
        ]);

        denverescala::create([
            'etiqueta' => 'Fallo',
            'abreviatura' => 'F'
        ]);


        denverescala::create([
            'etiqueta' => 'Retraso',
            'abreviatura' => 'R'
        ]);


        denverescala::create([
            'etiqueta' => 'No evaluable',
            'abreviatura' => 'N'
        ]);

    }
}
