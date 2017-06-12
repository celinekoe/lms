<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $message = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

        DB::table('messages')->insert([
        	'receiver_id' => '1',
            'sender_id' => '2',
            'body' => $message,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('messages')->insert([
        	'receiver_id' => '2',
            'sender_id' => '1',
            'body' => $message,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
