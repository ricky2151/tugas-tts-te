<?php

use Illuminate\Database\Seeder;


class article_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([['title'=>'title1', 'body'=>'body1'], ['title'=>'title2', 'body'=>'body2']]);
    }
}
