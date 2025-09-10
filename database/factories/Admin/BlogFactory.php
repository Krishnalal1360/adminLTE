<?php

namespace Database\Factories\Admin;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin\BlogModel;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //
    protected $model = BlogModel::class;
    //
    public function definition(): array
    {
        return [
            //
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            //'file' => $this->faker->word() . ".jpg",
            //'file' => $this->faker->word() . $this->faker->fileExtension(),
            'file' => $this->faker->word() . '.' . $this->faker->randomElement(['jpg', 'jpeg', 'gif', 'png', 'bmp']),
        ];
    }
}
