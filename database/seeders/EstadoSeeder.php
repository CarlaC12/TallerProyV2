<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        Estado::create([
            'name' => 'angry',
            'description' => 'Enfado, estado emocional en el que una persona experimenta una intensa sensación de irritación, enfado o frustración',
        ]);

        Estado::create([
            'name' => 'disgust',
            'description' => 'Disgusto, emoción que se experimenta cuando algo es considerado ofensivo, desagradable, inaceptable o repulsivo',
        ]);

        Estado::create([
            'name' => 'fear',
            'description' => ' Miedo, emoción intensa y desagradable que se experimenta ante una amenaza o un peligro percibido',
        ]);

        Estado::create([
            'name' => 'happy',
            'description' => 'Feliz, estado emocional positivo de alegría, satisfacción y bienestar',
        ]);

        Estado::create([
            'name' => 'neutral',
            'description' => 'Neutral, estado emocional en el cual una persona no experimenta una emoción particularmente positiva o negativa',
        ]);

        Estado::create([
            'name' => 'sad',
            'description' => 'Triste, emoción negativa y melancólica que se experimenta cuando una persona se siente apenada, desanimada o desolada',
        ]);

        Estado::create([
            'name' => 'surprise',
            'description' => 'Sorpresa, emoción que se experimenta cuando alguien se encuentra con algo inesperado o fuera de lo común',
        ]);
    }

}
