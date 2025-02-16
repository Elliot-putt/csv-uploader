<?php

namespace Database\Factories;

use App\Modules\Homeowner\Models\Homeowner;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeownerFactory extends Factory {

    protected $model = Homeowner::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'initial' => $this->faker->word(),
            'last_name' => $this->faker->lastName(),
        ];
    }

}
