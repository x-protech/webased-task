<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->word;

        return [
            'name' => $name,
            'email' => 'info@'. $name .'.com',
            'website' => 'www.'. $name .'.com',
            'logo' => URL::asset("/img/forgot-password-office.jpeg")
        ];
    }
}
