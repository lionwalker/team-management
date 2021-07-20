<?php

namespace Database\Factories;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'telephone' => $this->faker->phoneNumber,
            'joined_date' => $this->faker->dateTimeThisYear,
            'current_route' => $this->faker->address,
            'comments' => $this->faker->text,
            'user_id' => 1,
        ];
    }
}
