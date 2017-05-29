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
            'name' => 'file1',
            'type' => 'video',
            'extension' => '.mp4',
            'url' => 'https://www.youtube.com/embed/WQZRb8L5awM?rel=0&modestbranding=1'
        ]);

        DB::table('files')->insert([
        	'subsection_id' => '1',
            'name' => 'file2',
            'type' => 'reading',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
        	'subsection_id' => '1',
            'name' => 'file3',
            'type' => 'reading',
            'extension' => '.docx',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview'
        ]);

        DB::table('files')->insert([
            'subsection_id' => '1',
            'name' => 'file4',
            'type' => 'reading',
            'extension' => '.pptx',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urMGFpNGMzZE1Gd2c/preview'
        ]);
    }
}
