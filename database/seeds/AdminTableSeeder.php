<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'login' => 'trololo',
                'surname' => 'Fisherman',
                'name' => 'Jhon',
                'password' => '123',
                'permissions' => 'admin',
            ],
            [
                'login' => 'lamba',
                'surname' => 'Jagger',
                'name' => 'Mikle',
                'password' => '123',
                'permissions' => 'admin',
            ],
            [
                'login' => 'dady cool',
                'surname' => 'Resto',
                'name' => 'Enny',
                'password' => '123',
                'permissions' => 'admin',
            ]
        ]);
    }
}
