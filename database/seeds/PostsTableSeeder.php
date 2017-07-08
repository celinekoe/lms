<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $post = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

      DB::table('posts')->insert([
     		'user_id' => 1,
     		'thread_id' => 1,
     		'body' => $post,
      ]);

      DB::table('posts')->insert([
     		'user_id' => 1,
     		'thread_id' => 1,
     		'body' => $post,
      ]);

      DB::table('posts')->insert([
     		'user_id' => 2,
     		'thread_id' => 2,
     		'body' => $post,
      ]);

      DB::table('posts')->insert([
        'user_id' => 2,
        'thread_id' => 2,
        'body' => $post,
      ]);
    }
}
