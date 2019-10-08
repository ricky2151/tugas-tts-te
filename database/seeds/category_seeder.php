<?php

use Illuminate\Database\Seeder;


class category_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([['name' => 'category1'], ['name' => 'category2']]);
    }
}
