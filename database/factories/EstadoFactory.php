<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estado>
 */
class EstadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static $indiceCurso = 0;
    private static $nombresEstados = [
        'Activo', 'Inactivo'
    ];

    public function definition(): array
    {
        $nombreEstado = self::$nombresEstados[self::$indiceCurso % count(self::$nombresEstados)];
        self::$indiceCurso++;

        return [
            'nombreEstado' => $nombreEstado,
        ];
    }
}
