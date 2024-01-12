<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $indiceCurso = 0;
    private static $nombresCursos = [
        'Transicion', 'Primero', 'Segundo', 'Tercero', 'Cuarto', 'Quinto',
        'Sexto', 'Septimo', 'Octavo', 'Noveno', 'Decimo', 'Undecimo'
    ];

    public function definition(): array
    {
        $nombreCurso = self::$nombresCursos[self::$indiceCurso % count(self::$nombresCursos)];
        self::$indiceCurso++;

        return [
            'nombreCurso' => $nombreCurso,
            'estado_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
