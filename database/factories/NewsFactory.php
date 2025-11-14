<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory


{
    static $user_id = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "titulo"=> $this->faker->sentence(3),
            "conteudo"=> $this->faker->sentence(50),
            "imagem_url"=> $this->faker->imageUrl(),
            "autor"=>static::$user_id,

        ];
    }
}
