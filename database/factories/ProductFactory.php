<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3, false),
            'slug' => $this->faker->unique()->slug,
            'summary' => $this->faker->text,
            'description' => $this->faker->paragraphs(3, true),
            'additional_info' => $this->faker->paragraphs(3, true),
            'return_cancellation' => $this->faker->paragraphs(3, true),
            'stock' => $this->faker->numberBetween(2, 10),
            'photo' => $this->faker->imageUrl('400', '200'),
            'size_guide' => $this->faker->imageUrl('80', '80'),
            'size' => $this->faker->randomElement(['S', 'M', 'L']),
            'price' => $this->faker->numberBetween(100, 1000),
            'offer_price' => $this->faker->numberBetween(100, 1000),
            'discount' => $this->faker->numberBetween(100, 1000),
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            // 'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'cat_id' => $this->faker->randomElement(Category::where('is_parent', 1)->pluck('id')->toArray()),
            'child_cat_id' => $this->faker->randomElement(Category::where('is_parent', 0)->pluck('id')->toArray()),
            'condition' => $this->faker->randomElement(['new', 'popular', 'winter']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'added_by' => 'admin'
        ];
    }
}
