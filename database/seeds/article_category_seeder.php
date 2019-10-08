<?php

use Illuminate\Database\Seeder;


class article_category_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_category')->insert([['article_id' => '1', 'category_id'=>'1'], ['article_id' => '1', 'category_id'=>'2']]);
    }
}
