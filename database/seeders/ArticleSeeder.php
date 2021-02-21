<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Article;
use App\Models\Views;
use App\Models\Rating;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Article::factory()
                   ->has(Views::factory()->count(100))
                   ->has(Rating::factory()->count(10))
                   ->create();
    }
}
