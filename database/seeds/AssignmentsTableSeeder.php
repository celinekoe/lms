<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignments')->insert([
        	'unit_id' => '1',
            'name' => 'assignment1',
            'submit_by_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s')
        ]);

        DB::table('assignments')->insert([
        	'unit_id' => '1',
            'name' => 'assignment2',
            'submit_by_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s')
        ]);

        DB::table('assignments')->insert([
        	'unit_id' => '1',
            'name' => 'assignment3',
            'submit_by_date' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s')
        ]);
    }
}
