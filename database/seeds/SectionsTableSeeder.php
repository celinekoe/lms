<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
       		'unit_id' => '1',
            'name' => 'Section1'
        ]);

        DB::table('sections')->insert([
        	'unit_id' => '1',
            'name' => 'Section2'
        ]);

        DB::table('sections')->insert([
        	'unit_id' => '1',
            'name' => 'Section3'
        ]);
    }
}
