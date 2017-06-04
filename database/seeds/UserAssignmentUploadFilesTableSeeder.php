<?php

use Illuminate\Database\Seeder;

class UserAssignmentUploadFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_assignment_upload_files')->insert([
        	'user_id' => '1',
        	'assignment_id' => '1',
            'name' => 'user_assignment_upload_file1',
            'type' => 'document',
            'extension' => '.docx',
            'url' => 'https://drive.google.com/subsection_file/d/0B4OsqsghY0urbFlsX1VzLW9INlU/preview'
        ]);
    }
}
