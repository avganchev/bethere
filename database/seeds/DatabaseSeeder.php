<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ganchev Anatolii',
            'email' => 'ganchclub@gmail.com',
            'password' => bcrypt('ghbdtn1986'),
        ]);
        DB::table('types')->insert([
            'name' => 'category',
            'description' => 'Категория',
        ]);
        DB::table('types')->insert([
            'name' => 'for',
            'description' => 'Для кого?',
        ]);
        DB::table('types')->insert([
            'name' => 'todo',
            'description' => 'Что делать?',
        ]);
        DB::table('types')->insert([
            'name' => 'where',
            'description' => 'Где?',
        ]);
    }
}
