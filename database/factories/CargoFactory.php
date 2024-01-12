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
            'nombreCargo' => $this->faker->randomElement(['Representante de Curso', 'Contralor', 'Personero']),
            'descripcionCargo' => $this->faker->text,
            'estado_id' => $this->faker->randomElement([1, 2]),

        ];
    }
}
