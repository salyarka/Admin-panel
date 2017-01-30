<?php

use Illuminate\Database\Seeder;

class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            ['title' => 'Тема 1'],
            ['title' => 'Тема 2'],
            ['title' => 'Тема 3'],
            ['title' => 'Тема 4'],
            ['title' => 'Тема 5'],
            ['title' => 'Тема 6']
        ]);
    }
}
