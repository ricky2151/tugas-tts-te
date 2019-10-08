<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(article_category_seeder::class);
        $this->call(article_seeder::class);
        $this->call(category_seeder::class);
    }
}
