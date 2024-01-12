<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numeroIdentificacion' => $this->faker->unique()->numerify('##########'),
            'nombreCompleto' => $this->faker->name(),
            'curso_id' => $this->faker->numberBetween(1, 12),
            'sexo' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'estado_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
