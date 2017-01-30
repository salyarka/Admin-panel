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
                'login' => 'admin',
                'surname' => 'admin',
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'superAdmin'
            ]
        ]);
    }
}
