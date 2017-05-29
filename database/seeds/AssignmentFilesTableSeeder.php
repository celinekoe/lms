<?php

use Illuminate\Database\Seeder;

class AssignmentFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignment_files')->insert([
        	'assignment_id' => '1',
            'name' => 'file2',
            'type' => 'reading',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);
    }
}
