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
            'name' => 'Test_student1',
            'email' => 'test_student1@gmail.com',
            'password' => bcrypt('test_student1'),
        ]);

        DB::table('users')->insert([
            'course_id' => 1,
            'name' => 'Test_student2',
            'email' => 'test_student2@gmail.com',
            'password' => bcrypt('test_student2'),
        ]);

        DB::table('users')->insert([
            'course_id' => 1,
            'name' => 'Test_staff1',
            'email' => 'test_staff1@gmail.com',
            'password' => bcrypt('test_staff1'),
        ]);
    }
}
