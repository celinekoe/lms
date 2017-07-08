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
            'name' => 'Test_user1',
            'email' => 'test_user1@gmail.com',
            'password' => bcrypt('test_user1'),
        ]);

        DB::table('users')->insert([
            'course_id' => 1,
            'name' => 'Test_user2',
            'email' => 'test_user2@gmail.com',
            'password' => bcrypt('test_user2'),
        ]);

        DB::table('users')->insert([
            'course_id' => 1,
            'name' => 'Test_user3',
            'email' => 'test_user3@gmail.com',
            'password' => bcrypt('test_user3'),
        ]);
    }
}
