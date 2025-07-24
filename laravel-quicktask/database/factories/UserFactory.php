<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        
        return [
            'name' => $firstName . ' ' . $lastName,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date('Y-m-d', '2000-01-01'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'address' => $this->faker->address(),
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'password' => Hash::make('123456'), // mật khẩu mặc định là 'password'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function male(): static
    {
        return $this->state(function (array $attributes) {
            $firstName = $this->faker->firstNameMale();
            $lastName = $this->faker->lastName();
            
            return [
                'first_name' => $firstName,
                'name' => $firstName . ' ' . $lastName,
                'gender' => 'male',
            ];
        });
    }

    /**
     * Indicate that the user is female.
     */
    public function female(): static
    {
        return $this->state(function (array $attributes) {
            $firstName = $this->faker->firstNameFemale();
            $lastName = $this->faker->lastName();
            
            return [
                'first_name' => $firstName,
                'name' => $firstName . ' ' . $lastName,
                'gender' => 'female',
            ];
        });
    }


    /**
     * Create user with Vietnamese phone format.
     */
    public function vietnamesePhone(): static
    {
        return $this->state(fn (array $attributes) => [
            'phone' => $this->faker->regexify('0[0-9]{9}'), // Format: 0xxxxxxxxx
        ]);
    }
}
