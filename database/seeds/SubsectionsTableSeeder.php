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
            'name' => 'subsection1'
        ]);

        DB::table('subsections')->insert([
        	'section_id' => '1',
            'name' => 'subsection2'
        ]);

        DB::table('subsections')->insert([
        	'section_id' => '1',
            'name' => 'subsection3'
        ]);
    }
}
