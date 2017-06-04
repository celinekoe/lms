<?php

use Illuminate\Database\Seeder;

class UserSubsectionFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_subsection_files')->insert([
       		'user_id' => '1',
       		'subsection_file_id' => '1',
       		'completed' => false,
          'downloaded' => false
        ]);

        DB::table('user_subsection_files')->insert([
       		'user_id' => '1',
       		'subsection_file_id' => '2',
          'completed' => false,
       		'downloaded' => false
        ]);

        DB::table('user_subsection_files')->insert([
       		'user_id' => '1',
       		'subsection_file_id' => '3',
          'completed' => false,
       		'downloaded' => false
        ]);

        DB::table('user_subsection_files')->insert([
       		'user_id' => '1',
       		'subsection_file_id' => '4',
          'completed' => false,
       		'downloaded' => false
        ]);
    }
}
