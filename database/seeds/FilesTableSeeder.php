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
        // Unit info files

        DB::table('files')->insert([
            'unit_id' => '1',
            'name' => 'Unit_info_file1',
            'extension' => '.mp4',
            'type' => 'video',
            'size' => 684175,
            'length' => '00:00:16',
            'url' => 'https://www.youtube.com/embed/WQZRb8L5awM?rel=0&modestbranding=1'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'name' => 'Unit_info_file2',
            'extension' => '.pdf',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'name' => 'Unit_info_file3',
            'extension' => '.docx',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'name' => 'Unit_info_file4',
            'extension' => '.pptx',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urMGFpNGMzZE1Gd2c/preview'
        ]);

        // Assignment files

        DB::table('files')->insert([
            'unit_id' => '1',
            'assignment_id' => '1',
            'name' => 'Assignment_file_1',
            'extension' => '.pdf',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'assignment_id' => '2',
            'name' => 'Assignment_file_2',
            'extension' => '.pdf',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'assignment_id' => '3',
            'name' => 'Assignment_file_3',
            'extension' => '.pdf',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'user_id' => '1',
            'unit_id' => '1',
            'assignment_id' => '1',
            'name' => 'Assignment_file_4',
            'type' => 'document',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'user_id' => '1',
            'unit_id' => '1',
            'assignment_id' => '2',
            'name' => 'Assignment_file_5',
            'extension' => '.pdf',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        // Subsection files

        DB::table('files')->insert([
            'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '1',
            'name' => 'Subsection_file1',
            'extension' => '.mp4',
            'type' => 'video',
            'size' => 684175,
            'length' => '00:00:16',
            'url' => 'https://www.youtube.com/embed/WQZRb8L5awM?rel=0&modestbranding=1'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '1',
            'name' => 'Subsection_file2',
            'extension' => '.pdf',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '1',
            'name' => 'Subsection_file3',
            'extension' => '.docx',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '1',
            'name' => 'Subsection_file4',
            'extension' => '.pptx',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urMGFpNGMzZE1Gd2c/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '2',
            'name' => 'Subsection_file5',
            'extension' => '.mp4',
            'type' => 'video',
            'size' => 684175,
            'length' => '00:00:16',
            'url' => 'https://www.youtube.com/embed/WQZRb8L5awM?rel=0&modestbranding=1'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '2',
            'name' => 'Subsection_file6',
            'extension' => '.pdf',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '2',
            'name' => 'Subsection_file7',
            'extension' => '.docx',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview'
        ]);

        DB::table('files')->insert([
            'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '2',
            'name' => 'Subsection_file8',
            'extension' => '.pptx',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urMGFpNGMzZE1Gd2c/preview'
        ]);
    }
}
