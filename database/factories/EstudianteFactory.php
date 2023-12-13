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
            'curso' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11']),
            'sexo' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'estado' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
