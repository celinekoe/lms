<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserAssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Test_user_1

        DB::table('user_assignments')->insert([
        	'student_id' => '1',
        	'staff_id' => 3,
        	'assignment_id' => 1,
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 100,
            'grade_comment' => 'gradecomment1',
            'graded_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_assignments')->insert([
            'student_id' => '1',
            'staff_id' => 3,
            'assignment_id' => 2,
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => null,
            'grade_comment' => null,
            'graded_at' => null,
        ]);

        DB::table('user_assignments')->insert([
            'student_id' => '1',
            'staff_id' => 3,
            'assignment_id' => 3,
            'submitted_at' => null,
            'grade' => null,
            'grade_comment' => null,
            'graded_at' => null,
        ]);

        // Test_user_2

        DB::table('user_assignments')->insert([
            'student_id' => 2,
            'staff_id' => 3,
            'assignment_id' => 1,
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 100,
            'grade_comment' => 'gradecomment1',
            'graded_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_assignments')->insert([
            'student_id' => 2,
            'staff_id' => 3,
            'assignment_id' => 2,
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => null,
            'grade_comment' => null,
            'graded_at' => null,
        ]);

        DB::table('user_assignments')->insert([
            'student_id' => 2,
            'staff_id' => 3,
            'assignment_id' => 3,
            'submitted_at' => null,
            'grade' => null,
            'grade_comment' => null,
            'graded_at' => null,
        ]);
    }
}
