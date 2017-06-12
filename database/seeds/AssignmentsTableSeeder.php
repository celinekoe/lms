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
            'name' => 'Assignment1',
            'weight' => 20,
            'submit_by_date' => Carbon::now()->addWeek()->format('Y-m-d H:i:s')
        ]);

        DB::table('assignments')->insert([
        	'unit_id' => '1',
            'name' => 'Assignment2',
            'weight' => 20,
            'submit_by_date' => Carbon::now()->addWeeks(2)->format('Y-m-d H:i:s')
        ]);
    }
}
