<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'name' => 'course1'
        ]);

        DB::table('courses')->insert([
            'name' => 'course2'
        ]);

        DB::table('courses')->insert([
            'name' => 'course3'
        ]);
    }
}
