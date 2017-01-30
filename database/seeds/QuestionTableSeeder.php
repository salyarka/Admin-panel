<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'topic_id' => '1',
                'status' => '1',
                'author_name' => 'author',
                'text' => 'Lorem ipsum dolor sit amet',
                'answer' => 'consectetur adipisicing elit,
                             sed do eiusmod tempor incididunt
                             ut labore et dolore magna aliqua'
            ],
            [
                'topic_id' => '1',
                'status' => '0',
                'author_name' => 'author',
                'text' => 'Ut enim ad minim veniam',
                'answer' => NULL
            ],
            [
                'topic_id' => '2',
                'status' => '1',
                'author_name' => 'author',
                'text' => 'Quis nostrud exercitation ullamco',
                'answer' => 'Laboris nisi ut aliquip ex ea commod'
            ],
            [
                'topic_id' => '2',
                'status' => '0',
                'author_name' => 'author',
                'text' => 'Duis aute irure dolor in reprehenderit',
                'answer' => NULL
            ],
        ]);
    }
}
