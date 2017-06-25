<?php

use Illuminate\Database\Seeder;

class SubsectionFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subsection_files')->insert([
       		'subsection_id' => '1',
            'name' => 'Subsection_file1',
            'type' => 'video',
            'extension' => '.mp4',
            'url' => 'https://www.youtube.com/embed/WQZRb8L5awM?rel=0&modestbranding=1'
        ]);

        DB::table('subsection_files')->insert([
        	'subsection_id' => '1',
            'name' => 'Subsection_file2',
            'type' => 'document',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('subsection_files')->insert([
        	'subsection_id' => '1',
            'name' => 'Subsection_file3',
            'type' => 'document',
            'extension' => '.docx',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview'
        ]);

        DB::table('subsection_files')->insert([
            'subsection_id' => '1',
            'name' => 'Subsection_file4',
            'type' => 'document',
            'extension' => '.pptx',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urMGFpNGMzZE1Gd2c/preview'
        ]);
    }
}
