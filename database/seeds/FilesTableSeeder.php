<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
       		'subsection_id' => '1',
            'name' => 'file1'
        ]);

        DB::table('files')->insert([
        	'subsection_id' => '1',
            'name' => 'file2'
        ]);

        DB::table('files')->insert([
        	'subsection_id' => '1',
            'name' => 'file3'
        ]);
    }
}
