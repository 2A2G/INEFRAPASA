<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cargo>
 */
class CargoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_cargo' => $this->faker->randomElement(['Representante de Curso', 'Contralor', 'Personero']),
            'descripcion_cargo' => $this->faker->text,
        ];
    }
}
