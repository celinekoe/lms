<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'course_id' => 1,
            'name' => 'Testuser1',
            'email' => 'testuser1@gmail.com',
            'password' => bcrypt('testuser1'),
        ]);

        DB::table('users')->insert([
            'course_id' => 1,
            'name' => 'Testuser2',
            'email' => 'testuser2@gmail.com',
            'password' => bcrypt('testuser2'),
        ]);
    }
}
