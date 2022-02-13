<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(50);
        $slug = Str::slug($title);
        return [
            'title' => $this->faker->text(50),
            'slug' => $slug,
            'thumbnail' => $this->faker->imageUrl(370, 240),
            'description' => $this->faker->text(500),
        ];
    }
}
