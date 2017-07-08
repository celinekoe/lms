<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('threads')->insert([
       		'user_id' => '1',
       		'forum_id' => '1',
       		'title' => 'Thread1',
            'created_at' => Carbon::now()
        ]);

        DB::table('threads')->insert([
        	'user_id' => '2',
        	'forum_id' => '1',
        	'title' => 'Thread2',
            'created_at' => Carbon::now()
        ]);
    }
}
