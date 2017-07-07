<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MessageThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_threads')->insert([
        	'user_id_1' => '1',
        	'user_id_2' => '2',
            'preview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
