<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_files')->insert([
            'user_id' => '1',
            'file_id' => '1',
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => '1',
            'file_id' => '2',
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => '1',
            'file_id' => '3',
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
            'user_id' => '1',
            'file_id' => '4',
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
        	'user_id' => '1',
        	'file_id' => '5',
            'completed' => false,
            'downloaded' => false,
            'uploaded' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_files')->insert([
        	'user_id' => '1',
        	'file_id' => '6',
            'completed' => false,
            'downloaded' => false,
            'uploaded' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
