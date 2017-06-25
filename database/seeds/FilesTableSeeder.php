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
            'name' => 'Subsection_file1',
            'type' => 'video',
            'extension' => '.mp4',
            'url' => 'https://www.youtube.com/embed/WQZRb8L5awM?rel=0&modestbranding=1'
        ]);

        DB::table('files')->insert([
            'subsection_id' => '1',
            'name' => 'Subsection_file2',
            'type' => 'document',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'subsection_id' => '1',
            'name' => 'Subsection_file3',
            'type' => 'document',
            'extension' => '.docx',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview'
        ]);

        DB::table('files')->insert([
            'subsection_id' => '1',
            'name' => 'Subsection_file4',
            'type' => 'document',
            'extension' => '.pptx',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urMGFpNGMzZE1Gd2c/preview'
        ]);

    	DB::table('files')->insert([
        	'assignment_id' => '1',
            'name' => 'Assignment_file_1',
            'type' => 'document',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
        	'user_id' => '1',
        	'assignment_id' => '1',
            'name' => 'Assignment_file_2',
            'type' => 'document',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'user_id' => '1',
            'assignment_id' => '2',
            'name' => 'Assignment_file_3',
            'type' => 'document',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);
    }
}
