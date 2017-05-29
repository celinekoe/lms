<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('units')->insert([
       		'course_id' => '1',
            'name' => 'unit1',
            'info' => 'unitinfo1'
        ]);

        DB::table('units')->insert([
        	'course_id' => '1',
            'name' => 'unit2',
            'info' => 'unitinfo2'
        ]);

        DB::table('units')->insert([
        	'course_id' => '1',
            'name' => 'unit3',
            'info' => 'unitinfo2'
        ]);
    }
}
