<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
//use App\Models\ChatUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatUser>
 */
class chatUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     //protected $model = ChatUser::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name()
        ];
    }
}
