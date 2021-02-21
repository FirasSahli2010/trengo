<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Article;
use App\Models\Views;
use App\Models\Rating;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Category::factory()
                   ->count(10)
                   ->has(
                     Article::factory()->count(100)
                      ->has(Views::factory()->count(100))
                      ->has(Rating::factory()->count(10))
                    )
                   ->create();
    }
}
