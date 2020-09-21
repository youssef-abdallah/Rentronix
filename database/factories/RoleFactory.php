<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles=['Admin','Customer','Buyer'];
        return [

            'name' => $this->faker->randomElement($roles),
            'label' => $this->faker->text,
        ];
    }
}
