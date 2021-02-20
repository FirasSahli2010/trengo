<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Views;


class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Rating::factory()
                   ->create();
    }
}
