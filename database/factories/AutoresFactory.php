<?php

namespace Database\Factories;

use App\Autores;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutorFactory extends Factory
{
    protected $model = Autores::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'apellido' => $this->faker->name
        ];
    }
}