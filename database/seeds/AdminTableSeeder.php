<?php

use Illuminate\Support\Facades\Hash;
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
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ],
            [
                'login' => 'lamba',
                'surname' => 'Jagger',
                'name' => 'Mikle',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ],
            [
                'login' => 'dady cool',
                'surname' => 'Resto',
                'name' => 'Enny',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ],
            [
                'login' => 'admin',
                'surname' => 'admin',
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'superAdmin',
            ],
        ]);
    }
}
