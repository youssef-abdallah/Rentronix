<?php

namespace Database\Factories;


use App\Models\Promocode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromocodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promocode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

        'expiredDate'=> $this->faker->dateTime,
            'promocode'=> $this->faker->postcode,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Promocode $promo) {})->afterCreating(function (Promocode $product)
        {});
    }
}
