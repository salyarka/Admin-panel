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
                'status' => '0',
                'author_name' => 'salyarka',
                'text' => 'testoviy vopros',
                'answer' => 'tesoviy otvet 1'
            ],
            [
                'topic_id' => '1',
                'status' => '0',
                'author_name' => 'salyarka',
                'text' => 'testoviy vopros 2',
                'answer' => NULL
            ],
            [
                'topic_id' => '1',
                'status' => '0',
                'author_name' => 'salyarka',
                'text' => 'testoviy vopros 3',
                'answer' => 'testoviy otvet 2'
            ],
            [
                'topic_id' => '1',
                'status' => '0',
                'author_name' => 'salyarka',
                'text' => 'testoviy vopros 4',
                'answer' => NULL
            ],
        ]);
    }
}
