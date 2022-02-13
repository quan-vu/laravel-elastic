<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
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
            'id' => $this->faker->uuid(),
            'title' => $this->faker->text(50),
            'slug' => $slug,
            'thumbnail' => $this->faker->imageUrl(370, 240),
            'description' => $this->faker->text(500),
            'content' => $this->faker->randomHtml(),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
