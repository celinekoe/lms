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
        $announcement = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

        DB::table('announcements')->insert([
        	'user_id' => '1',
            'unit_id' => '1',
            'title' => 'title1',
            'body' => $announcement,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('announcements')->insert([
         	'user_id' => '1',
            'unit_id' => '1',
            'title' => 'title2',
            'body' => $announcement,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('announcements')->insert([
         	'user_id' => '1',
            'unit_id' => '1',
            'title' => 'title3',
            'body' => $announcement,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
