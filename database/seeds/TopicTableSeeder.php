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
            ['title' => 'Basics'],
            ['title' => 'Mobile'],
            ['title' => 'Account'],
            ['title' => 'Payments'],
            ['title' => 'Privacy'],
            ['title' => 'Delivery']
        ]);
    }
}
