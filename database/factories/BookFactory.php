<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = $this->faker->name();
        $slug = str::slug($name, '-');
        return [
            'category_id' => Category::factory(),
            'cover_photo' => $foto,
            'isbn' => Str::random(10),
            'title' => $name,
            'slug' => $slug,
            'author' => $this->faker->name(),
            'publisher' => $this->faker->name(),
            'price' => random_int(10000, 500000),
            'stock' => random_int(1, 50),
        ];
    }
}
