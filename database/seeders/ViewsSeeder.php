<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Rating;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      View::factory()
                   ->create();
    }
}
