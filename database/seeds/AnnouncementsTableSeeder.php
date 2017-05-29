<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->insert([
        	'user_id' => '1',
            'unit_id' => '1',
            'title' => 'title1',
            'body' => 'body1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('announcements')->insert([
         	'user_id' => '1',
            'unit_id' => '1',
            'title' => 'title2',
            'body' => 'body2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('announcements')->insert([
         	'user_id' => '1',
            'unit_id' => '1',
            'title' => 'title3',
            'body' => 'body3',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
