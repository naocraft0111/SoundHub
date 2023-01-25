<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Image;
class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()->count(5)->create()->each(fn($tweet) =>
            Image::factory()->count(4)->create()->each(fn($image) =>
                $tweet->images()->attach($image->id)
            )
        );
    }
}
