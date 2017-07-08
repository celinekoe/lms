<?php

use Illuminate\Database\Seeder;

class SubsectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subsections')->insert([
       		'section_id' => '1',
            'name' => 'Subsection1'
        ]);

        DB::table('subsections')->insert([
        	'section_id' => '1',
            'name' => 'Subsection2'
        ]);

        DB::table('subsections')->insert([
        	'section_id' => '1',
            'name' => 'Subsection3'
        ]);

        DB::table('subsections')->insert([
            'section_id' => '2',
            'name' => 'Subsection4'
        ]);
    }
}
