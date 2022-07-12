<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'street' => $this->faker->streetAddress(),
            'district' => $this->faker->randomElement(['campo grande','vitoria']),
            'zip_code' => $this->faker->randomElement(['29156567','29712010', '29190216', '29160772', '29307406']),
            'number' => $this->faker->randomElement([$this->faker->numberBetween(1,200) ,'s/n']),
            'complement' => $this->faker->word,
            'city' => $this->faker->city(),
            'state' =>  $this->faker->randomElement(['ES' ,'RJ','SP','MG','RS']),
        ];
    }
}
